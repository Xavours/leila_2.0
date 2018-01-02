module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),
		meta: {
			banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
				'<%= grunt.template.today("yyyy-mm-dd") %>\n' +
				'<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
				'* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
				' Licensed <%= pkg.license %> */\n'
		},

		//  Convert SASS files into CSS  
		sass: {
			options: {
				sourceMap: true
			},
			dist: {
				files:  [{
					expand: true,
					cwd: 'scss/',
					src: ['*.scss','!variable.scss'],
					dest: 'css/',
					ext: '.css'
				}]
			}
		},

		//  Minify CSS  
		cssmin: {
			target: {
				files: {
					'min/app.min.css': 'css/*.css'
				}
			}
		},

		//  Autoprefix CSS  
		autoprefixer: {
			styles: {
				files: {
					'min/app.min.css': 'min/app.min.css'
				}
			}
		},

		//  Watch 
		watch: {
			scripts: {
				files: ['!**/*.css', '**/*.scss', '**/*.js', 'gruntfile.js','*.html'],
				tasks: ['work'],
				options: {
					livereload: true,
				},
			},
		},

		//  Minify JS
		uglify: {
			options: {
				mangle: false
			},
			my_target: {
				files: {
					'min/app.min.js': ['js/*.js', '!js/jquery.visible.min.js']
				}
			}
		},

		//  Upload files
		'sftp-deploy': {
			build: {
				auth: {
					host: 'home430615955.1and1-data.host',
					port: 22,
					authKey: 'key1'
				},
				cache: 'sftpCache.json',
				src: 'min/',
				dest: 'clickandbuilds/XavierOrssaud/wp-content/themes/leila_2.0/min/',
				exclusions: ['min/**/.DS_Store', 'min/**/Thumbs.db', 'dist/tmp'],
				serverSep: '/',
				concurrency: 4,
				progress: true
			}
		},

		//  Clean .css and .css.map from sass files
		clean: ["css/*.css.map"],

		// //  Optimize images
		// imagemin: {
		// 	dynamic: {
		// 		files: [{
		// 			expand: true,
		// 			cwd: 'images/',
		// 			src: ['**/*.{png,jpg,gif}'],
		// 			dest: 'dist/'
		// 		}]
		// 	}
		// }
	});


	// load grunt modules
	require('load-grunt-tasks')(grunt);

	// Default task(s)
	grunt.registerTask('default', ['work', 'watch']);

	grunt.registerTask('build', ['work', 'imagemin']);
	grunt.registerTask('work', ['styles', 'uglify', 'sftp-deploy']);
	grunt.registerTask('styles', ['sass', 'cssmin', 'autoprefixer:styles', 'clean']);

};
