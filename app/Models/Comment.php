<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Comment extends Model
    {
        use HasFactory;

        protected $fillable = [
            'body',
            'user_id',
            'post_id',
        ];
        protected $casts = [
            'body' => 'array',
        ];

        public function post() : BelongsTo
        {
            return $this->belongsTo(Post::class, 'post_id');
        }
    }
