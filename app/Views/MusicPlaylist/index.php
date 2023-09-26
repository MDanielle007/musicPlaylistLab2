<?php include 'include/top.php'; ?>
<body>
    <?php include 'include/playlistModal.php'; ?>
    <?php include 'include/addToPlaylist.php';?>

    <form action="/searchSong" method="get">
        <input type="search" name="search" placeholder="search song">
        <button type="submit" class="btn btn-primary">search</button>
    </form>
    
    <h1>Music Player</h1>
    <a href="/" class="btn btn-primary">All Songs</a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        My Playlist
    </button>

    <a href="/addSong/" class="btn btn-primary">Add Song</a>

    <audio id="audio" controls></audio>
    <ul id="playlist">
        <?php foreach($songs as $song):?>
            <li data-src="<?=base_url('/uploads/songs/'.$song['SongFileAddress']);?>">
                <?=$song['SongName']?>
                <button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" 
                    data-bs-target="#myModal"
                    onclick="setMusicID('<?=$song['id']?>')">
                    +
                </button>
                <?php if(!empty($song['playlist_track_id'])):?>
                    <a href="/deleteFromPlaylist/<?=$song['playlist_track_id']?>" class="btn btn-danger">-</a>
                <?php endif;?>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include 'include/bottom.php'?>
</body>
</html> 