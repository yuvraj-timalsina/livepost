<?php
    
    use App\Models\User;
    use App\Models\Post;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    return new class extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('post_user', static function (Blueprint $table) {
                $table->foreignIdFor(User::class)->index()->constrained()->cascadeOnDelete();
                $table->foreignIdFor(Post::class)->index()->constrained()->cascadeOnDelete();
                $table->primary(['user_id', 'post_id']);
            });
        }
        
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('post_user');
        }
    };
