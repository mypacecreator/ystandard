# yStandard

![yStandard](./screenshot.png "yStandard")

## カスタマイズありきの一風変わったWordPressテーマ「yStandard」

yStandardは「自分色に染めた、自分だけのサイトを作る楽しさ」を感じてもらうために作った一風変わったテーマです

詳しくは公式サイトをご覧ください

[yStandard](https://wp-ystandard.com/)

## 「yStandard」の由来

「標準」といった意味の「Standard」に作者が自作物やハンドルネームによく使う「ys」というフレーズをくっつけて、「yStandard」にしました。

先頭の「y」に意味はなく、発音する必要も無いと思っておりましたが、「yStandard」を「y」の部分まで発音すると「why standard」に聞こえることから"一風変わった"というコンセプトを掲げています

## 必要な動作環境

- WordPress : 5.4以上
- PHP : 7.3以上

## 変更履歴

### v4.x.x

### v4.30.4
- [修正] 背景あり＆アーカイブページをリストタイプにしている場合のレイアウト不具合の修正
- [修正] カラーパレット用CSS作成機能不具合の修正

### v4.30.3
- [修正] IE互換機能の不具合修正

### v4.30.2
- [追加] 関連記事表示カスタマイズ用フック追加
- [修正] モバイルフッターがない場合にJSでエラーが発生する点の修正

### v4.30.1
- [調整] yStandard Toolbox v1.15.0向け調整
- [修正] ブロックエディターにフックで追加したCSSカスタムプロパティが出力されるように修正

### v4.30.0
- [調整] ヘッダータイプ①のレイアウト調整
- [調整] アーカイブ一覧 リストタイプレイアウト調整
- [調整] カスタマイザー：アーカイブ一覧レイアウト選択肢画像変更
- [調整] (上級者向け) アクションフック名変更 set_singular_content -> ys_set_singular_content
- [追加] (上級者向け) カスタマイザーのアーカイブ一覧レイアウト一覧変更用フック追加
- [追加] (上級者向け) 新着記事一覧ウィジェット 表示タイプ一覧変更用フック追加

### v4.29.2
- [修正] ヘッダーを影あり設定にしている場合、モバイルメニューの上に一部コンテンツが重なる問題の修正
- [調整] ページ先頭へ戻るボタンの位置調整

### v4.29.1
- [追加] Safariでのページ内リンクのスムーススクロール対応

### v4.29.0
- [追加] yStandard Blocks v3.0.0向け調整
- [調整] 区切り線ブロックの調整

### v4.28.1
- [修正] 固定ヘッダー時のコンテンツ開始位置自動調整機能でヘッダーオーバーレイ時に不具合がある点の修正

### v4.28.0
- [追加] ブロック：カラーパレットで使える色の変更・追加
- [追加] カスタマイザーにブロック用カラーパレット選択追加
- [追加] 投稿本文エリアの背景色設定追加
- [追加] 固定ヘッダー時のコンテンツ開始位置自動調整機能追加
- [修正] グローバルメニュー内アイコンのモバイル表示修正
- [修正] og:descriptionが「meta descriptionに使用する文字数」の設定以下で切り取られる不具合修正
- [調整] Dart Sass対応
- [調整] アイコン ショートコード一覧画面処理変更
- [調整] CSSカスタムプロパティ一部変更
	- 変更 : `--site-cover` -> `--global-nav-search-cover`
	- 追加 : `--tagcloud-icon`

### v4.27.3
- [修正] 記事上部ウィジェットで目次ウィジェットを使用したときにリンクが機能しない不具合修正

### v4.27.2
- [調整] グループブロックスタイル調整

### v4.27.1
- [調整] いくつかのブロックスタイル調整
	- グループブロック
	- 画像ブロック
	- 最近のコメント
	- リストブロック

### v4.27.0
- [調整] WordPress 5.8対応
- [追加] 記事上部カテゴリー表示にリンク追加
- [調整] ysパーツ機能調整
- [削除] Font Awesome関連機能の削除

### v4.26.3
- [調整] ヘッダーメディアの動画がiPhoneでも自動再生されるように調整
- [調整] ヘッダーメディアの動画表示サイズを自動調整されるように調整

### v4.26.2
- [修正] 管理画面ダッシュボードの「yStandardのお知らせ」でエラーが発生する場合がある点の修正
- [調整] テンプレート内コメントの調整

### v4.26.1
- [追加] モバイルフッター表示判断フック追加
- [追加] 1カラムテンプレート判断フック追加
- [追加] タイトルなしテンプレート判断フック追加
- [追加] フル幅テンプレート判断フック追加

### v4.26.0
- [追加] WooCommerce対応（β）
- [修正] ブログカードショートコード展開不具合修正

### v4.25.0
- [追加] 投稿個別設定をカスタム投稿にも追加
- [追加] 「投稿ページ」（投稿一覧）のヘッダーサムネイル画像表示機能追加
- [追加] サポート用システム情報コピー機能追加
- [修正] パンくずリスト構造化データ「名前のないアイテム」対処

### v4.24.2
- [追加] PHPバージョン、WordPressバージョンチェック追加
- [修正] グローバルメニューのサブメニューが長いときに横スクロールが発生する不具合修正

### v4.24.1
- [修正] PHP構文エラーの修正(PHP 7.2以下)

### v4.24.0
- [追加] 検索フォーム内にアクションフックを追加
- [追加] グローバルメニューのモーダル検索フォームのテンプレートを分割
- [追加] サブフッター上下余白設定追加
- [追加] ページ先頭に戻るボタンの縦・横のサイズを揃える（正方形にする）かどうか選べる設定を追加
- [調整] Font Awesome設定の削除準備
- [調整] コンテンツ内の空の段落ブロック（pタグ）は表示しないようにCSSを調整
- [調整] 幅広・全幅のスタイル調整
- [修正] パンくずリスト 構造化データ不具合修正
- [修正] グローバルナビゲーション 最後のメニューのサブメニューが画面からはみ出す不具合の修正

### v4.23.3
- [修正] ページ内リンクのスクロール不具合の修正

### v4.23.2
- [修正] カスタム見出しを最初の見出しにすると目次表示がおかしくなる点の修正
- [修正] グローバルナビゲーション 検索フォームの閉じるボタンの翻訳対応
- [修正] PHP 5.6エラー回避
- [調整] グローバルナビゲーションにページ内リンクを設定した際、モバイルメニューのリンククリックでメニューが閉じるように調整

### v4.23.1
- [修正] フロントページ設定で固定ページのタイトルが空の場合にパンくずリストのエラーが出る問題の対処
- [修正] カスタム投稿タイプでアーカイブなしの場合にパンくずリストのエラーが出る問題の対処

### v4.23.0
- [追加] yStandard Toolbox 1.10.0向け連携機能調整

### v4.22.3
- [修正] ブロックエディター上の太字スタイル調整

### v4.22.2
- [修正] アイコン取得処理周りの調整
- [修正] キャッチフレーズが空の場合にサイト概要のHTMLを出力しないように修正
- [調整] サイトヘッダー（横一列表示）の場合、サイトロゴ・タイトルとメニューの高さが大きく違う場合でも中央に揃えるように調整

### v4.22.1
- [修正] 管理画面内 マニュアルリンク付近に余分な余白ができる点の修正
- [調整] yStandardを始めよう！ページの刷新

### v4.22.0
- [追加] グローバルメニュー前後カスタマイズ用フック追加
	- `template-parts/header/global-nav.php`
- [追加] TOPページ（フロントページ）ではページタイトル等を非表示に
- [修正] ysパーツ管理画面で一覧並び替えが出来ない点の修正
- [調整] WordPress 5.7向け調整
- [調整] 画像ブロック全幅スタイル調整
  - 全幅画像が続く場合、画像間の余白を削除
- [調整] ギャラリーブロックスタイル調整
- [調整] ブロック編集画面スタイル調整
	- 区切り


### v4.21.3
- [調整] マニュアルリンク調整
- [調整] ソーシャルアイコンブロックスタイル調整

### v4.21.2
- [調整] マニュアルリンク調整

### v4.21.1
- [追加] 目次カスタマイズ用フック追加
	- `ys_toc_title`
	- `ys_toc_title_html`
	- `ys_toc_list_html`
	- `ys_toc_html`
- [修正] 編集画面で引用ブロックが左に寄ってしまう点の修正

### v4.21.0
- [追加] アーカイブページに続きを読むリンクを表示する設定追加

### v4.20.3
- [調整] マニュアルリンク調整

### v4.20.2
- [修正] yStandard Toolboxのヘッダーオーバーレイ使用時に検索ボックスの背景が透明になる不具合対処
- [修正] [ys]著者情報表示ウィジェット 不具合修正

### v4.20.1
- [修正] モバイルナビゲーションの上にモバイルフッターが重なる不具合修正
- [修正] 同じ文言の見出しが複数ある場合に目次用idが正しく採番されない不具合の修正

### v4.20.0
- [追加] Google Analytics 追加パラーメーターカスタマイズ用フック(`ys_google_analytics_additional_config_info`)追加
- [調整] Google Analytics設定欄のGoogle Analytics 4向け説明文調整

### v4.19.1
- [調整] サイト名取得処理の調整

### v4.19.0
- [調整] マニュアルリンク調整
- [調整] 詳細ページ フル幅ヘッダー表示の画像表示調整

### v4.18.3
- [修正] ys-partsを使ったページでレイアウトが崩れる恐れがある点の修正

### v4.18.2
- [修正] Googleマップを複数埋め込み表示した際に、レスポンシブ対応用変換が2重以上かかる事がある点の修正
- [調整] ファイルブロックのスタイル調整
- [調整] update npm package

### v4.18.1
- [調整] マニュアルリンク調整

### v4.18.0
- [追加] 新着記事一覧ショートコードに表示記事数と表示タイプをデスクトップとモバイル表示で切り替えられる機能追加
- [調整] WordPress 5.6向け調整

### v4.17.0
- [追加] カスタム投稿タイプ・カスタムタクソノミー向けテンプレート読み込みルール追加
- [調整] `ys_get_archive_item_class`にクラス指定用引数追加
- [修正] カスタム投稿タイプ向け 記事下カテゴリー表示条件判定の不具合修正

### v4.16.0
- [追加] シェアボタンショートコード Twitterハッシュタグ追加
- [追加] 投稿詳細ページ ページフッターをまとめて非表示にするフック追加
- [追加] ワイド幅レイアウト判定変更フック追加
- [追加] タイトル無しテンプレート条件変更フック追加
- [追加] 「関連記事」文字変更フック追加
- [追加] ヘッダーアイキャッチ変更用画像フック追加
- [修正] 目次表示の不具合修正
- [調整] 年・月・日、検索結果 アーカイブタイトル調整
- [調整] 404ページ見出し調整
- [調整] テーマカスタマイザーのプレビュー背景色を白に変更
- [調整] カテゴリーアーカイブページ説明文周りの余白調整

### v4.15.4
- [調整] マニュアルリンク変更

### v4.15.3
- [修正] 背景色あり＆タイトルなしテンプレートの場合のコンテンツ周りの余白不具合修正

### v4.15.2
- [追加] おすすめプラグイン表示機能を停止するフックを追加
- [修正] 背景色あり＆タイトルなしテンプレートの場合のコンテンツ周りの余白調整
- [調整] アイコン表示処理変更（KUSANAGI環境向け対処）

### v4.15.1
- [修正] ヘッダーロゴ揃え位置不具合修正

### v4.15.0
- [追加] yStandardのカスタムテンプレートをカスタム投稿タイプでも選択可能に
- [追加] カスタム投稿タイプ別の投稿ヘッダー切り替えフック追加
- [修正] ysパーツで作成したコンテンツのoEmbed展開不具合の修正
- [修正] ファイルブロックのボタンにCSS変数の色設定が反映されるように修正
- [修正] ヘッダーロゴ周りの細かな余白削除
- [調整] ブロックの全幅を設定した場合にスクロールバー分ズレが発生する点の調整
- [調整] ysパーツでは目次機能が有効にならないように調整
- [調整] マニュアルのリンク調整

### v4.14.0
- [追加] カスタム投稿タイプ対応
- [追加] 1カラム表示条件書き換えフック追加
- [追加] アイキャッチ表示条件書き換えフック追加
- [追加] 詳細ページ日付情報表示条件書き換えフック追加
- [追加] 詳細ページタクソノミー表示条件書き換えフック追加
- [追加] 詳細ページシェアボタン表示条件書き換えフック追加
- [追加] 詳細ページ関連記事表示条件書き換えフック追加
- [追加] 詳細ページ次の記事・前の記事表示条件書き換えフック追加
- [追加] 詳細ページ広告表示条件書き換えフック追加
- [追加] 詳細ページ広告表示条件書き換えフック追加
- [追加] アーカイブページタクソノミー表示条件書き換えフック追加
- [追加] タクソノミーアイコン書き換えフック追加
- [修正] yStandardのお知らせ取得不具合修正
- [調整] [ys]パーツの並び順を日付順に変更
- [調整] メディアと文章ブロック調整

### v4.13.2
- [追加] 一覧ページ日付情報書き換え用フック追加

### v4.13.1
- [追加] 一覧ページデフォルト画像用フックに画像サイズを追加

### v4.13.0
- [追加] アイキャッチがない場合に表示される画像を変更するフック追加

### v4.12.4
- [調整] パーツ機能の調整

### v4.12.3
- [調整] 広告表示条件変更用フック追加
- [修正] フッターウィジェットで全幅ブロックを使うと横スクロールが発生する不具合の対処

### v4.12.2
- [調整] 投稿オプション追加用フックの調整

### v4.12.1
- [修正] ヘッダーメディアにショートコードを利用した際の不具合修正
- [調整] パーツ編集メニューのアイコン調整

### v4.12.0
- [追加] 固定ページの抜粋入力を追加
- [追加] 投稿設定に「OGP/Twitter Cards用タイトル」を追加
- [修正] ヘッダーメディアにショートコードで全幅ブロックを挿入すると横スクロールが発生する点の修正
- [修正] 投稿ヘッダーなしテンプレートでアイキャッチが表示されることがある点の修正
- [調整] モバイルメニュー調整
- [調整] 投稿設定の整理・整頓

### v4.11.0
- [追加] Googleマップの自動レスポンシブ表示機能にキャンセルと比率の指定機能を追加
- [追加] yStandardメニューアイコン追加
- [修正] 目次機能不具合修正
- [修正] サブフッターに全幅コンテンツを追加すると横スクロールが発生する点の修正
- [調整] 幅広、全幅のレイアウト調整
- [調整] 画像ブロック・ギャラリーブロックのキャプションスタイル調整

### v4.10.2
- [修正] OGPタグ作成用処理でのエラー対処
- [修正] 環境によってjQueryが読み込まれない点の対処
- [修正] IE11向けCSS不具合調整
- [追加] IE11向けscript,css読み込みフック追加（`ys_enqueue_polyfill_scripts`,`ys_enqueue_polyfill_styles`）

### v4.10.1
- [調整] 記事一覧ショートコード カードスタイルでの下線削除
- [調整] カラムブロック モバイルでの余白調整
- [調整] 画像ブロック キャプションスタイル調整

### v4.10.0
- [追加] グローバルナビゲーションのメニュー幅変更機能追加
- [追加] ヘッダーボックスシャドウ設定追加
- [追加] ページ先頭へ戻るボタン表示設定追加
- [調整] ページ内スムーススクロールの動作調整

### v4.9.2
- [調整] カバーブロック内部の余白調整
- [調整] カラムブロック内部の余白調整

### v4.9.1
- [修正] サイトヘッダー周りの余白調整
- [修正] Twitterシェアボタンでタイトルが途中で切れる問題の修正
- [調整] フロントページにも固定ページデザイン設定を適用
- [調整] 著者情報ウィジェットタイトル調整
- [調整] ブロックエディター内のスタイル調整
- [調整] おすすめプラグインから「Lazy Load - Optimize Images」を削除

### v4.9.0
- [追加] XMLサイトマップ出力設定（WordPress 5.5対応）
- [修正] 記事一覧でアイキャッチ画像がない場合アイコン色が青くなる点の修正
- [調整] yStandardからのお知らせ調整（WordPress 5.5対応）
- [調整] テキストカラー指定のCSS調整

### v4.8.1
- [追加] 新着記事一覧ショートコード ブロックエディタープレビュースタイル追加（yStandard Toolbox対応）
- [調整] 動画ブロックの全幅スタイル調整
- [調整] 管理画面用JavaScriptの依存関係調整
- [調整] フッターエリアの余白調整

### v4.8.0
- [追加] 段落ブロックのline-heightサポート（WordPress 5.5対応）
- [追加] ウィジェットのアクセシビリティ対応（WordPress 5.5対応）
- [調整] CSS変数出力機能の変更（`ys_css_vars`フックに影響あり）

### v4.7.0
- [追加] 著者情報表示ウィジェットに非表示設定との連動オプションを追加

### v4.6.0
- [調整] 投稿ヘッダー無しテンプレートのコンテンツ域 上下余白調整・背景色削除
- [調整] 全幅設定ブロックの調整

### v4.5.1
- [修正] 一部環境でテンプレートエラーが発生する点の対処
- [修正] フッターウィジェット間の余白調整

### v4.5.0
- [修正] 記事一覧（カードタイプ）で右側に空白ができる問題の修正
- [調整] 記事一覧の画像部分もリンクとして機能するように調整

### v4.4.1
- [修正] SNSシェアボタンを押した時に表示されるタイトルが途中で切れる事がある点の修正

### v4.4.0
- [修正] 最新記事ショートコードで非公開記事が含まれたままキャッシュ作成されてしまう点の修正
- [修正] ウィジェットタイトルが保存されない点の修正
- [調整] 新着記事ウィジェット初期値調整
- [調整] 新着記事ショートコード 列数指定機能の調整
- [調整] キャッシュ機能 ログイン中はキャッシュを取得・作成しないように調整
- [調整] コメント周りのスタイル調整

### v4.3.1
- [修正] コメント欄で class-wp-user.php 関連のエラーが発生する事がある点の修正

### v4.3.0
- [追加] アーカイブレイアウトカスタマイズ用フック`ys_get_archive_type`を追加
- [追加] アーカイブ明細クラスカスタマイズ用フック`get_archive_item_class`を追加
- [追加] モバイル判定用関数`ys_is_mobile`を追加

### v4.2.4
- [修正] 目次ウィジェットでタイトルが表示されなくなる場合がある点の修正
- [調整] 目次設定　設定項目の並び調整

### v4.2.3
- [修正] パンくずリスト構造化データのposition指定不具合修正
- [修正] 目次を無効化する投稿タイプに[ys]パーツが混ざって表示されている点の修正
- [調整] シェアボタンのrel属性調整
- [調整] カスタムアバター取得処理調整
- [調整] モバイル表示でのページタイトルサイズ調整
- [調整] 一部環境でPHPエラーが発生する部分の処理調整

### v4.2.2
- [修正] シェアボタン表示タイプの初期値不具合修正
- [修正] シェアボタン：公式Twitterボタンで投稿ユーザーとおすすめユーザー設定が反映されない不具合の修正
- [修正] ヘッダーデザイン設定内 検索フォーム表示設定の文言修正
- [調整] PC検索フォーム表示微調整
- [調整] ビジュアルエディタ用CSS調整

### v4.2.1
- [修正] ヘッダーを中央寄せにしていると、モバイルメニューの並びも中央寄せになってしまう点の修正
- [修正] 最新の投稿ブロックの抜粋表示不具合修正
- [調整] マニュアルリンクのレイアウト調整
- [調整] マニュアルリンクのリンク調整

### v4.2.0
- [追加] サイト全体の文字色・薄文字色の設定追加
- [追加] アイキャッチ画像の表示・非表示を切り替える設定追加
- [追加] アーカイブページサムネイル変更用フック追加
  - template-parts/archive/details.php
  - template-parts/archive/details-list.php
- [修正] フッターメインエリアのデフォルトカラーがカスタマイザーと表示側で違う点の修正
- [調整] 編集画面:グループブロックで背景色ありの時の上下余白調整 
- [調整] カテゴリー・タグの表示スタイル調整 
- [調整] グローバルメニューでメニュー項目が多い場合、モバイルではスクロールするように調整 
- [調整] フッターメニューを中央寄せに変更
- [調整] タグクラウドレイアウト調整

### v4.1.0
- [追加] お知らせバーに複数のリンクを設定出来る機能追加
- [追加] お知らせバーで絵文字を使えるように修正
- [修正] 投稿内にXMLがあるとdescription自動生成がおかしくなる点の修正
- [修正] ギャラリーブロックのキャプションが中央表示されない点の修正
- [修正] 記事詳細下の関連記事一覧がスマートフォンで見た時に右側の余白が大きい点の修正
- [修正] 投稿一覧ページのレイアウト修正
  - template-parts/header/header-logo.php
- [修正] 背景色ありレイアウト - 一覧ページ（リスト）の画像周りの余白調整
- [修正] 投稿一覧ウィジェットで長いタイトルを入力すると画面からはみ出ることがある点の修正
- [修正] アイキャッチ画像の表示判断に旧設定の読み込みが紛れている点の修正

### v4.0.8
- [修正] グローバルナビゲーションを表示していない時にJavaScriptのエラーが発生する点の修正

### v4.0.7
- [修正] yStandardのお知らせ機能調整

### v4.0.6
- [修正] SNSシェアボタンアイコン表示不具合修正

### v4.0.5
- [修正] 新着記事・関連記事のキャッシュ機能不具合修正
- [修正] アイコン ショートコード一覧ページで一部のSNSアイコンがコピーできない点の修正
- [調整] yStandardからのお知らせをキャッシュ
- [調整] 一覧ページレイアウトの余白調整
- [調整] パーツ機能のフィルター調整
- [調整] SNSアイコン表示ショートコードのHTML構造調整
- [調整] アイコン表示の初期サイズ指定
- [調整] Spotifyの埋め込みでサムネイル下に隙間が出来る点の調整

### v4.0.4
- [修正] 「AMPエラー：参照している AMP URL はスタンドアロン AMP です」が発生する点の修正

### v4.0.3
- [追加] 「yStandardを始めよう！」ページにカスタマイザーのリンクを追加
- [調整] 拡張機能設定のパネル表示位置の調整

#### v4.0.2
- [追加] サイドバー無効化フック追加
- [修正] モバイルフッターメニューの表示・非表示切り替えをハンバーガーメニューに揃える
- [修正] モバイルフッターメニューのアイコン表示サイズを揃える

#### v4.0.1
- [修正] 著者情報のSNSアイコンでWebのアイコンが下にずれる点の修正
- [修正] スペーサーブロックmargin-topが効いてしまう点の修正
- [修正] おすすめプラグイン機能　翻訳調整
- [修正] アーカイブページ 概要文の2ページ目以降削除

#### v4.0.0
- [追加] v4.0.0リリース

### v3.x.x

v3以前の履歴は以下のページをご覧ください。  
https://wp-ystandard.com/ystandard-update/ystandard-update-old/



## Third-party resources

### normalize.css
License: MIT License  
Source : <https://github.com/necolas/normalize.css>

### Simple Icons
License: CC0 - 1.0  
Source : <https://github.com/simple-icons/simple-icons>

### Feather
License: MIT  
Source : <https://github.com/feathericons/feather>

### Theme Update Checker Library

License: MIT License  
Source : <https://github.com/YahnisElsts/plugin-update-checker>

### TGM-Plugin-Activation

License: GPL-2.0  
Source : <https://github.com/TGMPA/TGM-Plugin-Activation>

### \_decimal.scss

License: MIT License  
Source : <https://gist.github.com/terkel/4373420>

### css-vars-ponyfill

License: MIT License  
Source : <https://github.com/jhildenbiddle/css-vars-ponyfill>

### object-fit-images

License: MIT License  
Source : <https://github.com/fregante/object-fit-images>

### Smooth Scroll behavior polyfill

License: MIT License  
Source : <https://github.com/iamdustan/smoothscroll>
