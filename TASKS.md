# Tasks

## GENERAL

- [x] テスト環境の構築
- [x] githubでテストの実行とcoverageの取得を設定する

## Builder

## PhpFileBuilder

- [x] 名前空間の処理を移植

### PhpClassBuilder

- [x] 名前空間の設定・取得
- [x] 名前空間ビルドのテスト
- [ ] クラス定義のビルド
- [ ] クラス定義ビルドのテスト
- [ ] プロパティのビルド
- [ ] プロパティビルドのテスト
- [ ] コンストラクタのビルド
- [ ] コンストラクタビルドのテスト

### CommentBuilder

- [x] 標準的なコメントのビルド
- [x] コメントビルドのテスト
- [ ] PhpDocのビルド（別クラスにするかも）

### HtmlTagBuilder

- [x] タグビルダーの実装開始
- [x] tagContentにインデントを付与
- [ ] 複数行のtagContentに対応+インデントレベル

## PartsBuilder

### PropertyPartsBuilder

- [x] プロパティのビルド
- [x] コメントのビルド
- [x] プロパティビルドのテスト
- [x] コメントビルドのテスト

## Trait

### Buildable

- [x] ビルド系ユーティリティメソッドを提供

### Commentable

- [x] CommentBuilderのビルドメソッドをCommentableに継承
