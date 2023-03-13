<?php  

Route::prefix('artisan')->group(function(){
	Route::get('migrations/{schema}', function($schema) {
	    Artisan::call("make:migration {$schema}");
	    shell_exec('chmod -R 777 /var/www/html/banquet');
	});

	Route::get('migrate', function() {
	    Artisan::call('migrate');
	});

	Route::get('rollback', function() {
	    Artisan::call('migrate:rollback');
	});

	Route::get('controller/{schema}', function($schema) {
	    Artisan::call("make:controller {$schema}");
	    shell_exec('chmod -R 777 /var/www/html/banquet');
	});

	Route::get('model/{schema}', function($schema) {
	    Artisan::call("make:model {$schema}");
	    shell_exec('chmod -R 777 /var/www/html/banquet');
	});

	Route::get('middleware/{schema}', function($schema) {
	    Artisan::call("make:middleware {$schema}");
	    shell_exec('chmod -R 777 /var/www/html/banquet');
	});

	Route::get('model_with_migration/{schema}',function($schema){
		Artisan::call("make:model {$schema} --migration");
		shell_exec('chmod -R 777 /var/www/html/banquet');
	});

	Route::get('route-cache', function(){
	Artisan::call("route:cache");
	});
});


?>