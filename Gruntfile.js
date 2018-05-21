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

		//  Watch 
		watch: {
			sass: {
				files: ['scss/*'],
				tasks: ['styles', 'sftp:changedfiles'],
				options: {
					livereload: true,
					spawn: false
				},
			},

			scripts: {
				files: ['js/*'],
				tasks: ['uglify', 'sftp:changedfiles'],
				options: {
					livereload: true,
					spawn: false
				},
			},

			php: {
				files: ['*.php','*/*.php'],
				tasks: ['sftp:changedfiles'],
				options: {
					livereload: true,
					spawn: false
				},
			},
		},

		//  Deploy the whole thing
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

		secret: grunt.file.readJSON('ftppass.json'),
		sftp: {
		  changedfiles: {
		    files: {
		      './': 'min/app.min.css'
		    },
		    options: {
		      path: 'clickandbuilds/XavierOrssaud/wp-content/themes/leila_2.0',
		      host: '<%= secret.host %>',
		      username: '<%= secret.username %>',
		      password: '<%= secret.password %>',
		      showProgress: true,
		    }
		  }
		},
		sshexec: {
		  changedfiles: {
		    command: 'uptime',
		    options: {
		      host: '<%= secret.host %>',
		      username: '<%= secret.username %>',
		      password: '<%= secret.password %>'
		    }
		  }
		}
	});

	grunt.event.on('watch', function(action, filepath, target) {
		if ( target =="sass") {
			grunt.log.writeln('******************  SASS CHANGED  ******************');
			grunt.config('sftp.changedfiles.files', {"./": 'min/app.min.css'});
		} else if ( target =="scripts") {
			grunt.log.writeln('******************  JS CHANGED  ******************');
			grunt.config('sftp.changedfiles.files', {"./": 'min/app.min.js'});
		} else if ( target =="php") {
			grunt.log.writeln('******************  PHP CHANGED  ******************');
			grunt.config('sftp.changedfiles.files', {"./": filepath});
		}
	});

	// load grunt modules
	require('load-grunt-tasks')(grunt);

	// Default task(s)
	grunt.registerTask('default', ['work', 'watch']);

	grunt.registerTask('test', ['sftp:changedfiles']);
	grunt.registerTask('build', ['work', 'imagemin']);
	grunt.registerTask('work', ['styles', 'uglify', 'sftp-deploy:build', 'watch']);
	grunt.registerTask('styles', ['sass', 'cssmin', 'autoprefixer:styles', 'clean']);

};
