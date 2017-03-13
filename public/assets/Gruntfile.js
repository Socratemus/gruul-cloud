module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    
    pkg: grunt.file.readJSON('package.json'),

    sass: { // Task
      
      dist: { // Target
        options: {
          style: 'expanded'
        },
        files: { 
          'css/main.css': 'scss/main.scss'
        }
      },
      
    },

    watch: {
      scss: {
        files: ['scss/**/*.scss'],
        tasks: ['sass'],
        options: {
          spawn: false,
        },
      }
    },

    copy: {

      dependencies : {
        files : [
            {
              cwd: 'node_modules/materialize-css/dist/js',
              expand: true,
              src: ['materialize.js'],
              dest: 'data/js'
            },
            {
              cwd: 'node_modules/materialize-css/fonts',
              expand: true,
              src: ['**'],
              dest: 'data/fonts'
            },
            {
              cwd: 'node_modules/materialize-css/sass',
              expand: true,
              src: ['**'],
              dest: 'data/scss/materialize'
            },
            {
              cwd: 'node_modules/jquery/dist',
              expand: true,
              src: ['jquery.js'],
              dest: 'data/js'
            }
        ]
      },
      
      install : {
          files : [
            {
              cwd: 'data/fonts',
              expand: true,
              src: ['**'],
              dest: 'assets/fonts'
            }, //fonts
            {
              cwd: 'data/js',
              expand: true,
              src: ['**'],
              dest: 'assets/js'
            }, //javascript
            {
              cwd : 'data/scss/materialize', 
              expand: true,
              src: ['**'],
              dest: 'assets/scss/materialize'
            }  //materialize
          ]
      }
      
    },
    
    concat : {
     
    },
    
    uglify: {

      materialize: {
          src: 'js/tmp/materialize.js',
          dest: 'js/materialize.min.js'
      },
      
      jquery: {
      
      }

    }

  });

  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.loadNpmTasks('grunt-contrib-copy');
  
  grunt.loadNpmTasks('grunt-contrib-concat');
  
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.loadNpmTasks('grunt-contrib-sass');
  
};