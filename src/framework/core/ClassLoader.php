<?php

class ClassLoader
{
    protected $dirs;

    /**
     * オートローダクラスを登録する
     * コールバックにloadClassメソッドが指定
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * ディレクト登録
     * core と modelsディレクトリからクラスファイルを読み込むため
     * より柔軟に対応するため探すディレクトリをいくつでも登録できるようにする。
     * オートロード対象とするディレクトリへのフルパスを指定します。それらが$dirsプロパティに追加されます
     *
     * @param [type] $dir
     * @return void
     */
    public function registerDir($dir)
    {
        $this->dirs[] = $dir;
    }

    /**
     * オートロード時に自動的に呼び出され、クラスファイルの読み込みを行う処理です。
     * オートロード時に呼び出された際、引数にはクラス名が渡されています。これを元にクラスファイルの読み込みを行います。
     * 　$dirsプロパティに設定されたディレクトリから「クラス名.php」を探し、見つかった場合はrequireで読み込みます。
     * 読み込んだ場合、それ以外の処理を行う必要はないのでreturnで処理を中断しています。
     *
     * @param [type] $class
     * @return void
     */
    public function loadClass($class)
    {
        foreach ($this->dirs as $dir) {
            $file = $dir . '/' .$class . '.php';
            if (is_readable($file)) {
                require $file;
                return;
            }
        }
    }
}
