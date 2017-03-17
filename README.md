# ystandard

![ystandard](./screenshot.png "ystandard")

## 普通とは一味違ったテーマ

サイト高速化、Google PageSpeed Insightsでの高得点獲得に重点を置きながら、比較的カスタマイズしやすい形を目指したテーマ

テンプレートと機能面をなるべく分離し、子テーマで拡張することを前提に作っています。

表示に関するいろいろな部分が関数化されていてやや癖のあるテーマですが、慣れれば子テーマでガツガツカスタマイズしていけるはずです…


## 標準的にあると嬉しい機能を盛り込む

ブログ運営・サイト制作をしていて「この機能が標準的に使えたらいい」という機能を続々盛り込んでいます。
（≒いつも同じようなプラグインをインストールして設定したり、同じようなコードを何度も書くのがめんどくさい）

詳しくは「主な機能」を御覧ください。

（※設定した情報は他のテーマと共有できませんので、テーマ変更の際に設定の変更・移行が大変になるかと思います。運営スタイルに合わせて利用を検討ください）


## 「ystandard」の由来

「標準」の意の「standard」に作者が自作物やハンドルネームによく使う「ys」というプレフィックスをくっつけて、「ystandard」にしました。
（「ys-standard」という案もありました。）

先頭の「y」に意味はなく、発音する必要も無いと思っておりましたが、「ystandard」を「y」の部分まで発音すると「why standard」に聞こえることから「普通とは一味違ったテーマ」というコンセプトを掲げています


## 必要な動作環境

- WordPress : 4.5以上
- PHP : 5.6以上


## 主な機能

- Google Analyticsのタグ出力を管理画面から設定可
- OGPの出力（管理画面で設定を行う必要あり）
- カテゴリー、タグ、日別ページのnoindex設定
- AMPフォーマット出力（β版）
- 筆者のSNSリンク出力機能
- 筆者の画像変更機能
- 記事毎にnoindexの設定が可能
- PageSpeed Insightsの提案に沿ったCSSの配信最適化
- 追従サイドバー機能
- 簡易的なPVカウント機能
- 関連する人気記事出力ウィジェット
- 広告表示用ウィジェット

## 注意事項

- モバイル表示ではサイドバー部分が出力されません（設定ページにて変更可）
- AMP表示では各ウィジェットが出力されません
- 絵文字関連のcss、javascriptが出力されません（設定ページにて変更可）
- oembed関連のcss、javascriptが出力されません（設定ページにて変更可）

## カスタマイザー

### サイトアイコン・apple touch icon

サイトアイコンとapple touch iconに別々の画像を指定可能

サイトアイコンには透過画像、apple touch iconには背景色有りの画像を指定すると良いと思います

### 色の変更

### サイト全体の設定

- サイト背景色
- サイト文字色
- サイト文字色（薄字）

### ヘッダー

- ヘッダー背景色
- ヘッダー文字色

### ナビゲーション

- ナビゲーション文字色（PC）
- ナビゲーションホバー時の下線（PC）
- ナビゲーション文字色（SP）
- ナビゲーション背景色（SP）
- ナビゲーション区切り線（SP）

### フッター

- フッター背景色
- フッター文字色


## テーマ独自のウィジェット

### 関連する人気記事出力ウィジェット

テーマに実装されている簡易PVカウント機能でカウントしたPV数を使用し人気記事のランキングを出力します。

個別記事・カテゴリーアーカイブページでは同一カテゴリーに属する記事のランキングを表示し、それ以外の場合はサイト全体の人気記事ランキングを表示します。

### 広告表示用ウィジェット

404ページと検索結果が0件の場合に設定した内容を出力しないウィジェットです。

「価値のないページ」に出力すると警告を受ける広告コード等の表示にお使いください。


## メニューについて

### メニュー位置

1. グローバルメニュー
2. フッターメニュー

上記2種類のメニューを用意

### メニュー階層

- グローバルメニュー
  - 子項目まで対応（孫項目については設定しても表示されません）
- フッターメニュー
  - 階層メニュー非対応。階層メニューを設定しても、親メニューしか表示されません。


## スタイルについて

### sass

ystandard側で作成したスタイルは`/sass/ystandard/`以下で定義しています。

`/sass/_ys_custom_variables.scss`で変数を上書き、`/sass/_ys_customize.scss`で作成するテーマ独自のスタイルを追加していく想定で作成しています。

## 設定項目

### 簡単設定

- SNSまとめて設定
  - Twitter
    - アカウント名
  - Facebook
    - app_id
    - admins

### 基本設定

- Copyright
  - 発行年
- アクセス解析設定
  - Google Analytics トラッキングID
- シェアボタン設定
  - Twitterシェアにviaを付加する（要Twitterアカウント名設定）
  - Twitterアカウント名
- OGP・Twitterカード設定
  - Facebook app_id
  - Facebook admins
  - Twitterアカウント名
  - OGPデフォルト画像
- サイト表示設定
  - モバイル表示でもサイドバー部分を出力する
  - 絵文字関連スタイルシート・スクリプトを出力する
  - oembed関連スタイルシート・スクリプトを出力する
- SNSフォローURL
  - Twitter
  - Facebook
  - Google+
  - Instagram
  - tumblr
  - Youtube
  - Github
  - Pinterest
  - LinkedIn
- 投稿設定
  - 同じカテゴリーの関連記事を出力する
  - 次の記事・前の記事を出力しない
- SEO対策設定
  - アーカイブページのnoindex設定
- 広告設定
  - 記事タイトル下
  - moreタグ部分
  - PC表示：記事本文下（左右）
  - スマホ表示：記事本文下

### 高度な設定

- 投稿設定
  - 個別ページでアイキャッチ画像を表示しない
- css,javascript設定
  - テーマカスタマイザーの色設定を無効にする
  - jQueryをCDNから読み込む（URLを設定）　（※追加予定）
- AMP有効化
  - AMPページを生成する（β）

### AMP設定（β）

- シェアボタン設定
  - Facebook app_id
- 通常ビューへのリンク表示
  - コンテンツ上部
  - シェアボタン下
- AMP記事作成条件設定
  - scriptタグの削除
  - styleタグの削除
- 広告設定
  - 記事タイトル下
  - moreタグ部分
  - 記事本文下

## 色の変更に関するcssクラス

### ヘッダー

- ヘッダー背景色
  - `.color-site-header`
- サイトタイトル文字色
  - `.color-site-title`
- サイトキャッチコピー文字色
  - `.color-site-dscr`

### ナビゲーション

- ブレークポイント
  - SP/Tablet
    - `@media screen and (max-width: 959px) {}`（テーマデフォルト）
  - PC
    - `@media screen and (min-width: 960px) {}`（テーマデフォルト）

- ナビゲーション文字色
  - SP/PC
    - `.gloval-menu>li a`

- ナビゲーション背景色
  - SP
    - `.site-header-menu`
  - PC
    - なし

- ナビゲーション ホバー時の下線
  - SP
    - なし
  - PC
    - `.gloval-menu>li:hover a`
    - `.gloval-menu>li:hover.menu-item-has-children a:hover`

### 汎用的なスタイル
- `.ys-box`
- `.ys-button`
- `.ys-button-block`
- `.ys-text-left`
- `.ys-text-center`
- `.ys-text-right`

## 変更履歴

### v0.2.0
- x0.2.2 : 2017/03/17 構造化エラー対処、次の記事・前の記事スタイル調整
- v0.2.1 : 2017/03/10 HTML5 バリデーションエラー対処等のバグフィックス（#8~#11,#14~#23,#25）
- v0.2.0 : 2017/03/01 ベータ版一般公開

### v0.1.x
- v0.1.4 : 2017/02/27 テーマカスタマイザーに色変更機能を追加
- v0.1.3 : 2017/02/19 ログイン中はGoogle Analyticsのトラッキングタグを出力しないように調整、一覧ページの画像が縦横比固定で出力されるように調整
- v0.1.2 : 2017/02/16 404ページ調整,検索結果ページのアーカイブタイトル修正
- v0.1.1 : 2017/02/12 個別投稿の構造化データでauthorがエラーになる問題対処
- v0.1.0 : ~~2017/02/12 ベータ版公開~~

### v0.0.x

- 2017/02/06：ソース管理をGitHubに移行
- 2016/12/xx：「Google PageSpeed Insightsでの高得点を出しやすい」「速い」をコンセプトに再作成開始
- 2016/11/15：とりあえずGithubにて公開…の予定をやっぱりやめてもう一度構想から練り直し
- 2016/10/xx：開発開始
