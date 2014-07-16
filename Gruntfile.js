module.exports = function (grunt) {

    "use strict";

    grunt.initConfig({
        dirs: {
            css: 'src/app/public/css',
            sass: 'src/app/sass'
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
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['css']);
    grunt.registerTask('css', ['sass']);
};
