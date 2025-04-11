<?php
$posts = file_exists('posts.txt') ? file('posts.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add' && isset($_POST['title']) && isset($_POST['content'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        
        if (!empty($title) && !empty($content)) {
            $post = $title . '|' . $content . "\n";
            file_put_contents('posts.txt', $post . file_get_contents('posts.txt'), LOCK_EX);
        }
    }
    
    elseif ($action === 'delete' && isset($_POST['index'])) {
        $index = (int)$_POST['index'];
        if (isset($posts[$index])) {
            unset($posts[$index]);
            file_put_contents('posts.txt', implode("\n", array_values($posts)) . "\n", LOCK_EX);
        }
    }
}

header('Location: index.php?page=admin');
exit;
