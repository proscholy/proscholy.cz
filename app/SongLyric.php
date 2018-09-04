<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SongLyric
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $is_authorized
 * @property int|null $is_original
 * @property string|null $description
 * @property string|null $lyrics
 * @property int|null $is_opensong
 * @property int|null $lang_id
 * @property int|null $song_id
 * @property int|null $licence_type
 * @property string|null $licence_content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Author[] $authors
 * @property-read \App\Song|null $song
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereIsAuthorized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereIsOpensong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereIsOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereLangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereLicenceContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereLicenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereLyrics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereSongId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $visits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Video[] $videos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SongLyric whereVisits($value)
 */
class SongLyric extends Model
{
    public function song(){
        return $this->belongsTo(Song::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function getLink()
    {
        if($this->is_original == 1)
        {
            $link = '<a href="'.route('song.single',['id'=>$this->song->id]).'">' . $this->name . '</a>';
        }
        else {
            $link = '<a href="'.route('translation.single',['id'=>$this->id]).'">' . $this->name . '</a>';
        }

        return $link;
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}