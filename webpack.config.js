const path = require('path')
const webpack = require('webpack')

module.exports = {
  mode: 'production',
  entry: './front/app.js',
  output: {
    path: path.resolve(__dirname, 'api/js'),
    filename: 'app.js',
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [
          'style-loader',
          'css-loader',
          'sass-loader'
        ]
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery'
    })
  ]
}