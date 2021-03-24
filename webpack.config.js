var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('./Resources/Public/Build')
    .setPublicPath('/Resources/Public/Build')

    .addEntry('frontend-js', './Resources/Private/JavaScript/Frontend.js')
    .addStyleEntry('backend-css', './Resources/Private/Style/Backend.scss')
    .copyFiles([{
        from: './node_modules/web-vitals/dist/',
        to: './[path][name].[ext]',
        pattern: /polyfill.js$/
    }])
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(false)
    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();