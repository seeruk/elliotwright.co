module.exports = function (grunt) {

    "use strict";

    grunt.initConfig({
        dirs: {
            adminCss: 'src/src/SeerUK/Modules/AdminModule/module/public/css/',
            blogCss: 'src/src/SeerUK/Modules/BlogModule/module/public/css/',
            adminSass: 'src/app/sass/admin/',
            blogSass: 'src/app/sass/blog/',
            coreSass: '/src/app/sass/'
        },
        compass: {
            dist: {
                options: {
                    config: 'config.rb'
                }
            }
        },
        watch: {
            css: {
                files: [
                    '<%= dirs.adminSass %>/*.scss',
                    '<%= dirs.blogSass %>/*.scss',
                    '<%= dirs.coreSass %>/*.scss',
                    '<%= dirs.coreSass %>/modules/*.scss',
                    '<%= dirs.coreSass %>/partials/*.scss',
                ],
                tasks: ['css'],
                options: {
                    spawn: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['css']);
    grunt.registerTask('css', ['compass']);
};
