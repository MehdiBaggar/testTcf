const Encore = require('@symfony/webpack-encore');
const path = require('path');
const webpack = require('webpack');

Encore
    .setOutputPath('public_html/build/')
    .setPublicPath('/build')
    .addEntry('app', './frontend/src/main.js')
    .enableVueLoader()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader();

const config = Encore.getWebpackConfig();

// Add alias for the '@' to resolve your src folder
config.resolve.alias = {
    '@': path.resolve(__dirname, 'frontend/src'),
    // Add an alias for "process/browser" explicitly
    'process/browser': require.resolve('process/browser'),
};

// Add fallback for process
config.resolve.fallback = {
    process: require.resolve('process/browser')
};

// Provide process globally
config.plugins.push(
    new webpack.ProvidePlugin({
        process: 'process/browser'
    })
);

module.exports = config;
