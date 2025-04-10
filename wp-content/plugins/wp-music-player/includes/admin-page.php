<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render the admin page content
 */
function wp_music_player_admin_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'music_playlists';
    $playlists = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
    $playlist_id = null;
    $songs = [];
    if(isset($_GET['playlist_id'])){
        $playlist_id = intval($_GET['playlist_id']);
        $playlist = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $playlist_id
        ));
        $songs = json_decode($playlist->songs, true);
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div class="playlist-maker-container">
            <div class="playlist-maker-header">
                <button type="button" class="button button-primary create-new-playlist">Add new playlist</button>
            </div>
        </div>  
        <!-- Existing Playlists -->
        <div class="card">
            <h2>Existing Playlists</h2>
            <?php if ($playlists): ?>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Shortcode</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($playlists as $playlist): ?>
                            <tr>
                                <td><?php echo esc_html($playlist->name); ?></td>
                                <td><code>[music_player playlist_id="<?php echo esc_attr($playlist->id); ?>"]</code></td>
                                <td><?php echo esc_html($playlist->created_at); ?></td>
                                <td>
                                    <button class="button edit-playlist" data-id="<?php echo esc_attr($playlist->id); ?>">Edit</button>
                                    <button class="button button-link-delete delete-playlist" data-id="<?php echo esc_attr($playlist->id); ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No playlists created yet.</p>
            <?php endif; ?>
        </div>

                <!-- Playlist Maker -->
        <div id="list_editor" class="card" style="display: <?php if( $playlist_id ==null) echo 'none'; else echo 'block'; ?>;">
            <h2>Songs in Playlists</h2>
            <div class="playlist-maker-container">
                <div class="playlist-maker-header">
                    <input type="text" class="playlist-name" placeholder="Playlist name">
                    <button type="button" class="button button-primary add-to-playlist">Add to current playlist</button>
                    <button type="button" class="button button-primary create-playlist">Save</button>
                </div>
                <div class="playlist">
                    <ul id="songs-container" class="playlist-songs">
                        <?php foreach ($songs as $index => $song): ?>
                            <li class="playlist-song" data-index="<?php echo esc_attr($index); ?>" data-url="<?php echo esc_url($song['url']); ?>">
                                <span class="song-number"><?php echo esc_html($index + 1); ?></span>
                                <span class="song-title"><?php echo esc_html($song['title']); ?></span>
                                <button type="button" class="button button-link-delete remove-song"><span class="dashicons dashicons-trash"></span></button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                 </div>
            </div>  
        </div>
    </div>
    <?php
}