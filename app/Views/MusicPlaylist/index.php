<?php include 'include/top.php'; ?>
<body>
    <?php include 'include/playlistModal.php'; ?>
    <?php include 'include/addToPlaylist.php';?>

    <form action="/searchSong" method="get">
        <input type="search" name="search" placeholder="search song">
        <button type="submit" class="btn btn-primary">search</button>
    </form>
    
    <h1>Music Player</h1>
    <a class="btn btn-primary" href="/">All Songs</a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        My Playlist
    </button>

    <a href="/addSong/" class="btn btn-primary">Add Song</a>

    <audio id="audio" controls autoplay></audio>
    <ul id="playlist">
        <?php foreach($songs as $song):?>
            <li data-src="<?=base_url('/uploads/songs/'.$song['SongFileAddress']);?>">
                <?=$song['SongName']?>
                <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#myModal"
                    onclick="setMusicID('<?=$song['id']?>')">
                    +
                </button>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include 'include/bottom.php'?>
</body>
</html> 