var gulp = require('gulp');
var webpack = require('webpack-stream');

// compiles frontend JS
gulp.task('compile_frontend_js', function(){
    gulp.start('bundle');
    gulp.start('edit_account');
    gulp.start('agent_search_results');
});


// bundles most of the JS in one file
gulp.task('bundle', function(){

    var options = ({
        output: {
            filename: 'bundle.js'
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
        },
        resolve: {
            extensions: ['.js', '.jsx']
        },
    });


    return gulp.src("./resources/assets/js/app.js")
        .pipe(webpack(options))
        .pipe(gulp.dest('./public/js/'));
});


// translates edit_account into javascript es5
gulp.task('edit_account', function(){

    var options = ({
        output: {
            filename: 'edit_account.js'
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
        },
        resolve: {
            extensions: ['.js', '.jsx']
        },
    });

    return gulp.src("./resources/assets/js/frontend/edit_account.js")
        .pipe(webpack(options))
        .pipe(gulp.dest('./public/js/'));
});


// translates edit_account into javascript es5
gulp.task('agent_search_results', function(){

    var options = ({
        output: {
            filename: 'agent_search_results.js'
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
        },
        resolve: {
            extensions: ['.js', '.jsx']
        },
    });

    return gulp.src("./resources/assets/js/frontend/agent_results/index.js")
        .pipe(webpack(options))
        .pipe(gulp.dest('./public/js/'));
});














