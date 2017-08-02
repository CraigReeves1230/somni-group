
module.exports = {
    entry: "./resources/assets/js/app.js",
    output: {
        filename: "./public/js/bundle.js"
    },
    module: {
        loaders: [
            {
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    }
};

module.exports = {
    entry: "./resources/assets/js/auth/register_form.js",
    output: {
        filename: "./public/js/auth/register_form.js"
    },
    module: {
        loaders: [
            {
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    }
};

module.exports = {
    entry: "./resources/assets/js/auth/login_form.js",
    output: {
        filename: "./public/js/auth/login_form.js"
    },
    module: {
        loaders: [
            {
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    }
};

module.exports = {
    entry: "./resources/assets/js/auth/password_reset.js",
    output: {
        filename: "./public/js/auth/password_reset.js"
    },
    module: {
        loaders: [
            {
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    }
};

module.exports = {
    entry: "./resources/assets/js/frontend/add_listing.js",
    output: {
        filename: "./public/js/frontend/add_listing.js"
    },
    module: {
        loaders: [
            {
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    }
};

