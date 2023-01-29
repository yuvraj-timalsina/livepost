<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    
    class Post extends Model
    {
        use HasFactory;
        
        protected $casts = [
            'body' => 'array',
        ];
        
        
        public function title(): Attribute
        {
            return new Attribute(
                get: fn($value) => strtoupper($value),
                set: fn($value) => strtolower($value),
            );
        }
        
        
        public function comments(): HasMany
        {
            return $this->hasMany(Comment::class, 'post_id');
        }
        
        
        public function users(): BelongsToMany
        {
            return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
        }
    }
