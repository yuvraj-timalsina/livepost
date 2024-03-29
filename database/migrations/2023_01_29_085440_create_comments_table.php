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
            Schema::create('comments', static function (Blueprint $table) {
                $table->id();
                $table->json('body')->nullable();
                $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
                $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
                $table->timestamps();
            });
        }
        
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('comments');
        }
    };
