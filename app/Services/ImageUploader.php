<?php

namespace App\Services;

use finfo;
use Throwable;
use RuntimeException;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * @mixin CrutchImage
 */
class ImageUploader
{
    /**
     * Качество картинок jpg при сохранении
     *
     * @var int
     */
    protected int $quality = 80;

    /**
     * Максимальная допустимая ширина
     *
     * @var int
     */
    protected int $max_width = 800;

    /**
     * Максимальная допустимая высота
     *
     * @var int
     */
    protected int $max_height = 1000;

    /**
     * Создавать новую директорию на основании даты
     *
     * @var bool
     */
    protected bool $partials_dir = true;

    /**
     * @var CrutchImage
     */
    protected CrutchImage $image;

    /**
     * @var string
     */
    protected string $tmp_name;

    /**
     * Имя файла
     *
     * @var string
     */
    protected string $file_name;

    /**
     * Абсолютный путь для загрузки изображений
     *
     * @var string
     */
    protected string $upload_path;

    /**
     * Путь загруженного файла без "/"
     *
     * @var string
     */
    protected string $path;

    /**
     * Допустимые mimeTypes и extensions
     *
     * @var string[]
     */
    protected static array $mime_types = [
        'image/gif'           => 'gif',
        'image/jpeg'          => 'jpg',
        'image/png'           => 'png',
        'image/webp'          => 'webp',
        'image/bmp'           => 'bmp',
        'image/x-ms-bmp'      => 'bmp',
        'image/x-windows-bmp' => 'bmp'
    ];

    /**
     * Возможные ошибки при загрузке файла
     *
     * @var string[]
     */
    protected static array $upload_errors = [
        1 => 'Размер принятого файла превысил максимально допустимый размер',
        2 => 'Размер загружаемого файла превысил значение, указанное в HTML-форме',
        3 => 'Загружаемый файл был получен только частично',
        4 => 'Файл не был загружен',
        6 => 'Отсутствует временная директория',
        7 => 'Не удалось записать файл на диск',
        8 => 'Модуль PHP остановил загрузку файла',
    ];

    /**
     * @param string $from
     *
     * @return static
     * @throws Throwable
     */
    public static function from(string $from)
    {
        try {
            if (empty($_FILES[$from]) || !isset($_FILES[$from]['error']) || empty($_FILES[$from]['tmp_name'])) {
                throw new InvalidArgumentException(static::$upload_errors[4]);
            }

            if (UPLOAD_ERR_OK !== $_FILES[$from]['error'] || !is_uploaded_file($_FILES[$from]['tmp_name'])) {
                throw new InvalidArgumentException(
                    static::$upload_errors[$_FILES[$from]['error']] ?? 'Ошибка [empty error] при загрузке файла'
                );
            }

            $fi = new finfo();
            $mime = $fi->file($_FILES[$from]['tmp_name'], FILEINFO_MIME_TYPE);

            if (!isset(static::$mime_types[$mime])) {
                throw new InvalidArgumentException("Недопустимый формат [{$mime}] для загрузки изображений");
            }

            return new static($_FILES[$from]['tmp_name']);
        } catch (Throwable $e) {
            !empty($_FILES[$from]['tmp_name']) && static::deleteTemporaryFile($_FILES[$from]['tmp_name']);
            throw $e;
        }
    }

    /**
     * @param string $tmp_name
     */
    public function __construct(string $tmp_name)
    {
        $this->image = new CrutchImage($tmp_name);
        $this->tmp_name = $tmp_name;
        $this->upload_path = public_path();
        $this->file_name = $this->generateFileName();
    }

    /**
     * Сохранить изображение
     *
     * @param string $dir_path
     *
     * @return static
     */
    public function save(string $dir_path = '')
    {
        try {
            return $this
                ->prepareForSave($dir_path)
                ->saveImage();
        } finally {
            static::deleteTemporaryFile($this->tmp_name);
        }
    }

    /**
     * @param string $dir_path
     *
     * @return static
     */
    public function saveWithoutGeneralSave(string $dir_path)
    {
        try {
            return $this->prepareForSave($dir_path)
                ->toFile("{$this->upload_path}/{$this->path}", null, $this->quality);
        } finally {
            static::deleteTemporaryFile($this->tmp_name);
        }
    }

    /**
     * Установка опции создания директории на основании даты
     *
     * @param bool $param
     *
     * @return static
     */
    public function setPartialsDir(bool $param = true): static
    {
        $this->partials_dir = $param;

        return $this;
    }

    /**
     * Установить максимальную ширину картинки
     * По умолчанию = 800
     *
     * @param int $max_width
     *
     * @return static
     */
    public function setMaxWidth(int $max_width): static
    {
        $this->max_width = $max_width;

        return $this;
    }

    /**
     * Установить максимальную высоту картинки
     * По умолчанию = 1000
     *
     * @param int $max_height
     *
     * @return static
     */
    public function setMaxHeight(int $max_height): static
    {
        $this->max_height = $max_height;

        return $this;
    }

    /**
     * Установить качество картинки jpg
     * По умолчанию = 80
     *
     * @param int $quality
     *
     * @return static
     */
    public function setQuality(int $quality): static
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Проверка на gif по mimetype
     *
     * @return bool
     */
    public function isGif(): bool
    {
        return 'image/gif' === $this->image->getMimeType();
    }

    /**
     * Получить путь загруженного файла
     *
     * @return string
     */
    public function getPath(): string
    {
        return "/{$this->path}";
    }

    /**
     * Получить объект изображения
     *
     * @return CrutchImage
     */
    public function getCrutchImage(): CrutchImage
    {
        return $this->image;
    }

    /**
     * @param string $dir_path
     *
     * @return static
     */
    protected function prepareForSave(string $dir_path): static
    {
        $dir_path = $this->generateDirectoryPath($dir_path);
        $this->createDirectory($dir_path);

        $this->path = "{$dir_path}/{$this->file_name}";

        return $this;
    }

    /**
     * @param string $dir_path
     *
     * @return string
     */
    protected function generateDirectoryPath(string $dir_path): string
    {
        if (true === $this->partials_dir) {
            $dir_path .= '/' . date('Y-m');
        }

        return trim($dir_path, '/');
    }

    /**
     * @param string $dir_path
     */
    protected function createDirectory(string $dir_path)
    {
        $dir = "{$this->upload_path}/{$dir_path}";

        if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new RuntimeException("Ошибка при создании директории [ {$dir_path} ]");
        }
    }

    /**
     * @return static
     */
    protected function saveImage(): static
    {
        if ($this->isGif()) {
            return $this->pureUpload();
        }

        return $this->crutchUpload();
    }

    /**
     * @return static
     */
    protected function pureUpload(): static
    {
        if (!move_uploaded_file($this->tmp_name, "{$this->upload_path}/{$this->path}")) {
            throw new RuntimeException('Не удалось загрузить картинку');
        }

        return $this;
    }

    /**
     * @return static
     */
    protected function crutchUpload(): static
    {
        $this->image
            ->autoOrient()
            ->bestFit($this->max_width, $this->max_height)
            ->toFile("{$this->upload_path}/{$this->path}", null, $this->quality);

        return $this;
    }

    /**
     * @return string
     */
    protected function generateFileName(): string
    {
        return date('dHi') . '-' . Str::random() . '.' . static::$mime_types[$this->image->getMimeType()];
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    protected static function deleteTemporaryFile(string $path): bool
    {
        return is_file($path) && @unlink($path);
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call(string $name, array $arguments): mixed
    {
        $result = $this->image->{$name}(...$arguments);

        if ($result instanceof CrutchImage) {
            return $this;
        }

        return $result;
    }
}
