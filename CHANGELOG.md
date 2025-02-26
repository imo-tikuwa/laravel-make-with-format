# Changelog

All notable changes to `laravel-make-with-format` will be documented in this file.

## v0.3.0 - 2025-02-26

### What's Changed

* Docker コンテナ内で操作したコマンドのヒストリーが作られない件について Dockerfile を修正 by @imo-tikuwa in https://github.com/imo-tikuwa/laravel-make-with-format/pull/1
* パッケージ固有のコンフィグファイルを用意。機能の有効/無効を制御する enabled オプションを追加（デフォルトは true） by @imo-tikuwa in https://github.com/imo-tikuwa/laravel-make-with-format/pull/2

### New Contributors

* @imo-tikuwa made their first contribution in https://github.com/imo-tikuwa/laravel-make-with-format/pull/1

**Full Changelog**: https://github.com/imo-tikuwa/laravel-make-with-format/compare/v0.2.0...v0.3.0

## v0.2.0 - 2025-02-23

- PintRunner の test/pest オプションの有無について正しく動作してなかったのを修正
- phpstan について実行時にエラーが起きていたのを修正

## v0.1.2 - 2025-02-23

パッケージとして公開する際に不要なコードを除く方法について composer.json ではなく .gitattributes で行うのが正しかったみたい。という修正

## v0.1.1 - 2025-02-23

パッケージ内にデモアプリなどが不要なコードが含まれてしまっていたのを修正

## v0.1.0 - 2025-02-23

test release.
