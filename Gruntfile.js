module.exports = function (grunt) {

    "use strict";

    grunt.initConfig({
        dirs: {
            css: 'src/app/public/css',
            js: 'src/app/public/js',
            src: {
                css: 'src/app/Resources/src/css',
                js: 'src/app/Resources/src/js',
                sass: 'src/app/Resources/src/sass'
            },
            vendor: 'src/app/Resources/vendor'
        },
        concat: {
            options: {
                seperator: ';'
            },
            css: {
                files: {
                    '<%= dirs.css %>/style.css': [
                        '<%= dirs.vendor %>/normalize.css/normalize.css',
                        '<%= dirs.src.css %>/**/*.css'
                    ]
                }
            },
            js: {
                files: {
                    '<%= dirs.js %>/scripts.js': [
                        '<%= dirs.vendor %>/jquery/dist/jquery.js',
                        '<%= dirs.src.js %>/**/*.js',
                    ]
                }
            }
        },
        cssmin: {
            dist: {
                files: {
                    '<%= dirs.css %>/style.min.css': ['<%= dirs.css %>/style.css']
                }
            }
        },
        sass: {
            options: {
                style: 'compressed'
            },
            dist: {
                files: {
                    '<%= dirs.src.css %>/style.css': ['<%= dirs.src.sass %>/style.scss']
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
                options: {
                    spawn: false
                },
                files: [
                    '<%= dirs.src.sass %>/**/*.scss'
                ],
                tasks: ['css']
            },
            js: {
                options: {
                    spawn: false
                },
                files: [
                    '<%= dirs.vendor %>/**/*.js'
                ],
                tasks: ['js']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['css', 'js']);
    grunt.registerTask('css', ['sass', 'concat:css', 'cssmin']);
    grunt.registerTask('js', ['concat:js', 'uglify']);
};
