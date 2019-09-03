var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')
    .addEntry('app', './src/AppBundle/Resources/assets/js/app.js')
    .addStyleEntry('main', './src/AppBundle/Resources/assets/css/main.css')
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();