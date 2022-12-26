const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  filenameHashing: false,
  publicPath: '/wp-content/themes/vuewithbundler/frontend/dist',
  chainWebpack: config => {
    config.plugins.delete('html');
    config.plugins.delete('preload');
    config.plugins.delete('prefetch');
  },
  devServer: {
    devMiddleware: {
      writeToDisk: true,
    },
    hot: false,
  },
  css: {
    extract: true,
  },
  runtimeCompiler: true
})
