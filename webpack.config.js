const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');

const isProd = process.env.NODE_ENV === 'production';
const isDev = !isProd;

const jsloaders = () =>{
  const loaders = [
    {
      loader: 'babel-loader',
      options: {
        presets: ['@babel/preset-env'],
        plugins: ['@babel/plugin-proposal-class-properties'],
      },
    },
  ];

  /*if (isDev) {
    loaders.push('eslint-loader');
  }*/
  return loaders;
};

module.exports = {
  // Директория исходников
  context: path.resolve(__dirname, 'src'),
  mode: 'development',
  // Входная точка для приложения (объект/строка)
  entry: ['@babel/polyfill', './index.js'],
 // entry: './index.js',
  // (объект)
  output: {
    // строчка с абсолютным путем
    //path: path.resolve(__dirname, 'dist/assets/'),
    path: path.resolve(__dirname, 'dist/wp-content/themes/astra-child/'),
    // будущий файл, который будет подключаться в браузер
    filename: 'assets/js/index.js',
    library: 'scorm-wrapper',
    libraryTarget: 'umd'
  },
  resolve: {
    extensions: ['.js'],
    // сокращения
    alias: {
      '@': path.resolve(__dirname, 'src'),
      '@js': path.resolve(__dirname, 'src/js'),
      '@inc': path.resolve(__dirname, 'src/js/inc'),
      //'@core': path.resolve(__dirname, 'src/core'),
    },
  },

  devServer: {
    // v5 - обновление стилей работает с коробки
    //port: 3000,
    hot: isDev,
    overlay: true,
    //contentBase: path.join(__dirname, 'dist'),
    openPage: '',
    writeToDisk: true,
    open: true,
  },
  devtool: 'source-map',
  //devtool: false,
  module: {
    // Описываем лоадеры
    rules: [
      {
        test: /\.s[ac]ss$/i,
        // размещать в таком порядке, компилируется справа на лево
        use: [
          // берем лодер с плагина
          {
            loader: MiniCssExtractPlugin.loader,
            // This is required for asset imports in CSS, such as url()
            // options: { publicPath: "" },
            options: { publicPath: "./dist/" },
          },
          'css-loader',
          'sass-loader',
          'group-css-media-queries-loader',

        ],
      },
      {
        test: /\.(png|jpg|gif|svg)$/i,
        use: [
          {
            loader: 'url-loader',
            options: {
              limit: 8192,
            },
          },
        ],
      },
      {
        test: /\.m?js$/,
        exclude: /node_modules/,
        use: jsloaders(),
      },
    ],
  },

  // массив плагинов
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'assets/css/custom.css'
    }),
  ],
};