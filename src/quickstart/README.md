# チュートリアル

TODO アプリを作るチュートリアル

## DataBase 作成

```shell
mysql -u root -proot
```

```sql
CREATE DATABASE `quickstart_php` DEFAULT CHARACTER SET utf8;
USE quickstart_php;
```

### テーブル作成

- id: 数値の連番（主キー）
- name: タスク名
- created_at: 登録日時
- updated_at: 更新日時

```sql
DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp,
  `updated_at` timestamp,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
```

## ディレクトリ構成

- quickstart
  - config
    - env.php
  - db
    - create_tasks_table.sql
  - public
    - index.php
    - task-store.php
    - task-delete.php
  - models
    - Model.php
    - Task.php
  - lib
    - functions.php
    - Session.php
    - Validate.php
  - app.php

### ①config ディレクトリ

  データベースに接続に必要な情報など

### ②db ディレクトリ

  データベース構築する際に使用するファイルの保存。sqlファイル等。

### ③public ディレクトリ

　ドキュメントルート。WEBサイトを外部に公開するためデータ設置場所。

### ④models ディレクトリ

　データベースへアクセスしてデータの取得や変更を行うファイルの設置場所。

### ⑤lib ディレクトリ

　アプリケーションを開発していく上でよく出現する処理を便利関数集をまとめたファイルの設置場所。

### app.php

アプリケーション全体で共通して使用するような処理をまとめたファイル。

## 各機能説明

### タスクの登録機能

タスクの登録機能は次の流れで処理を行います。

1. フォームを作成してタスクを入力し値を送信する
2. MySQLに接続し、quickstart データベースを選択
3. フォームに入力された内容のバリデーションを行う
4. 倍でーしょんエラーの有無で条件分岐をする
5. SQLのINSERT 文を作成し、保存処理を行う
