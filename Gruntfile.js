module.exports = function (grunt) {

    "use strict";

    grunt.initConfig({
        dirs: {
            css: 'src/app/public/css',
            js: 'src/app/public/js',
            sass: 'src/app/Resources/sass',
            vendor: 'src/app/Resources/vendor'
        },
        concat: {
            options: {
                seperator: ';'
            },
            dist: {
                files: {
                    '<%= dirs.js %>/scripts.js': [
                        '<%= dirs.vendor %>/jquery/dist/jquery.js'
                    ]
                }
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    '<%= dirs.css %>/style.css': '<%= dirs.sass %>/style.scss'
                }
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            dist: {
                files: {
                    '<%= dirs.js %>/scripts.min.js': ['<%= dirs.js %>/scripts.js']
                }
            }
        },
        watch: {
            css: {
                files: [
                    '<%= dirs.sass %>/*.scss',
                    '<%= dirs.sass %>/modules/*.scss',
                    '<%= dirs.sass %>/partials/*.scss',
                ],
                tasks: ['css'],
                options: {
                    spawn: false
                }
            },
            js: {
                files: [
                    '<%= dirs.vendor %>/**/*.js'
                ],
                tasks: ['js'],
                options: {
                    spawn: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['css']);
    grunt.registerTask('css', ['sass']);
    grunt.registerTask('js', ['concat', 'uglify']);
};
