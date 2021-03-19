var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('./Resources/Public/Build')
    .setPublicPath('/Resources/Public/Build')

    .addEntry('master-js', './Resources/Private/JavaScript/Main.js')
    .addStyleEntry('master-css', './Resources/Private/Style/Main.scss')
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(false)
    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();