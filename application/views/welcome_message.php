<div id="container">
    <h1><?= $this->lang->line('header_welcome') ?></h1>

    <div id="body">
        <select onchange="javascript:window.location.href = '<?php echo base_url(); ?>LanguageSwitcher/switchLang/' + this.value;">
            <option value="english" <?= ($this->session->userdata('site_lang') == 'english') ? 'selected="selected"' : ''; ?>>English</option>
            <option value="french" <?= ($this->session->userdata('site_lang') == 'french') ? 'selected="selected"' : ''; ?>>French</option>
            <option value="german" <?= ($this->session->userdata('site_lang') == 'german') ? 'selected="selected"' : ''; ?>>German</option>   
        </select>
        <?php if ($is_logged_in) { ?>
            <a href="<?php echo base_url('users/logout'); ?>" class="logout">Logout</a>
        <?php } else { ?>
            <a href="<?php echo base_url('users/login'); ?>" class="logout">Login</a>
        <?php } ?>
        <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

        <p>If you would like to edit this page you'll find it located at:</p>
        <code>application/views/welcome_message.php</code>

        <p>The corresponding controller for this page is found at:</p>
        <code>application/controllers/Welcome.php</code>

        <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<script src="/assets/js/welcome.js"></script>
