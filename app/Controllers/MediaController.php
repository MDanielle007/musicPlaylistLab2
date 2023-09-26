<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SongsModel;
use App\Models\PlaylistsModel;
use App\Models\PlaylistTracksModel;

class MediaController extends BaseController
{
    private $songs;
    private $playlists;
    private $playlistTracks;

    function __construct(){
        $this->songs = new SongsModel();
        $this->playlists = new PlaylistsModel();
        $this->playlistTracks = new PlaylistTracksModel();
    }

    public function index()
    {
        $data = [
            'songs'=>$this->songs->findAll(),
            'playlists' => $this->playlists->findAll()
        ];

        return view('MusicPlaylist\index', $data);
    }

    public function AddSongForm(){
        return redirect()->to('/uploadSongs');
    }

    public function searchSong(){

        $searchLike = $this->request->getVar('search');

        if(!empty($searchLike)){

            $data = [
                'songs' => $this->songs->like('SongName',$searchLike)->findAll(),
                'playlists' => $this->playlists->findAll()
            ];

            return view('MusicPlaylist\index', $data);
        }else{
            return redirect()->to('/');
        }
    }

    public function createPlaylist(){
        $data = [
            'PlaylistName' => $this->request->getVar('playlistName')
        ];

        $this->playlists->save($data);

        return redirect()->to('/');
    }

    public function addToPlaylist(){
        $data = [
            'Song_ID' => $this->request->getVar('musicID'),
            'Playlist_ID' => $this->request->getVar('playlist')
        ];

        $this->playlistTracks->save($data);

        return redirect()->to('/');
    }

    public function playlist($id = null){

        $db = \Config\Database::connect();
        $builder = $db->table('songs');

        $builder->select(['songs.id', 'songs.SongName', 'songs.SongFileAddress', 'playlist.PlaylistName','playlist.playlist_id']);
        $builder->join('playlist_track', 'songs.id = playlist_track.song_id');
        $builder->join('playlist', 'playlist_track.playlist_id = playlist.playlist_id');

        if ($id !== null) {
            $builder->where('playlist.playlist_id', $id);
        }
 
        $query = $builder->get();

        $data = [
            'songs' => $this->songs->findAll(),
            'playlists' => $this->playlists->findAll()
        ];

        if ($query) {
            $data['songs'] = $query->getResultArray();
        } else {
            echo "Query failed";
        }
        
        return view('MusicPlaylist\index', $data);
    }
}

