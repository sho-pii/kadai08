# kadai08
課題8　CRUD処理01

## DEMO

  - デプロイしている場合はURLを記入（任意）

## 紹介と使い方

  #### 画像を保存して表示するアプリ
  - 画像を選択し、「タイトル」と「詳細」を入力して、保存します。
  - 保存すると画面右側に、保存日時・画像・タイトル・いいねボタン・詳細が表示されます。
  - 保存日時が最新のものが上に表示されます。（降順）
  - 画像を押すと拡大され、矢印を押すと他の画像も表示されます。

## 工夫した点

  - 画面幅を調整し、画面右側の画像表示部だけスクロールするようにしました。
  - BootstrapとFontAwesome、Lightboxを使って見やすくしてみました。

## 苦戦した点

  - いいねボタンをつけてみましたが、クリック数の保存と更新の処理部分を記述するに至りませんでした。
  - 画像の保存処理と画像の表示処理をindex.phpと別のファイルにし、変数を読み込むのがうまくいかず苦戦しました。（保存の処理はindex.phpに書きました）

## 参考にした web サイトなど

  - 【PHP・MySQL】データベースに画像を保存・表示する方法｜Code for Fun https://codeforfun.jp/save-images-php-and-mysql/
  - Bootstrap · The most popular HTML, CSS, and JS library in the world. https://getbootstrap.com/
  - jQuery lightBox の使い方（PC用 固定サイズ版） | すぐ使えるサポート情報 https://support.sugutsukaeru.jp/ja/customize/homepage-design/185.html
  - Font Awesome（WEBアイコンフォント）の使い方・アニメーションetc カスタマイズ方法も【2020年保存版】 | WEB集客@poppyou　https://poppyou.com/font-awesome.html
  - PHPで500エラーが出たとき、エラーの中身を表示する方法 | Tanidaizのプログラミング備忘録・日記　https://onl.sc/asUjeiS
