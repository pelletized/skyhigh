module.exports = function(grunt) {
	
    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {   
			js: {
				src: [
					'src/js/libs/*.js', // All JS in the libs folder
					'src/js/main-dev.js'  // This specific file					
				],
				dest: 'js/main.js',
			},
			css: {
				src: [
					'src/css/*.css',					
				],
				dest: 'style.css',
			}			
		},
		
		uglify: {
			build: {
				src: 'js/main.js',
				dest: 'js/main.min.js'
			}
		},

		jshint: {
			files: [
				'src/js/main-dev.js'
			]		
		},
		
		sass: {
			dist: {
				options: {
					style: 'compressed', //prod
					//style: 'expanded', //dev					
					spawn: false,
					sourcemap: false					
				},
				files: {					
					'src/css/style.css': 'src/css/style.scss'
				}
			} 
		},
		
		watch: {
			scripts: {
				files: ['src/js/**/*.js'],
				tasks: ['concat:js', 'uglify'],
				options: {
					spawn: false,
				},
			},
			css: {
				files: ['src/css/**/*.scss'],
				tasks: ['sass', 'concat:css'],
				options: {
					spawn: false,
				}
			}
		}

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat', 'uglify']);    

	//5. run imagemin and jshint on it's own 
};
