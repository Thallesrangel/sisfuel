const { resolve } = require("path");
const TerserJSPlugin = require("terser-webpack-plugin");
const devMode = process.env.NODE_ENV !== "production";
module.exports = {
  entry: "./app/app/js/index.js",
  mode: devMode ? "development" : "production",
  output: {
    path: resolve(__dirname, "app", "app", "js"),
    filename: "build.bundle.js",
  },
  plugins: [],
  module: {
    rules: [],
  },
  optimization: {
    minimizer: [
      new TerserJSPlugin({
        sourceMap: true,
      }),
    ],
  },
};