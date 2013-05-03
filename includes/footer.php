<div id="footer">
    <ul>
        <li>
            <h3>External links</h3>
            <ul class="externallinks">
                <li class="google"><a href="maps.google.lv">google.lv</a></li>
                <li class="grauzti"><a href="http://grauzti.lv">grauzti.lv</a></li>
                <li class="diggers"><a href="http://diggers.lv">diggers.lv</a></li>
            </ul>
        </li>
        <li>
            <h3>Who we are?</h3>
            <p>
                <?php
                    $result = mysql_query('SELECT * FROM articles WHERE title = "About Us"');
                    $article = mysql_fetch_array($result, MYSQL_ASSOC);
                ?>
                <?php $text = (strlen($article['main_text']) > 450) ? substr($article['main_text'], 0, 450) . '...' : $article['main_text']; ?>
                <?php echo $text ?>
            </p>
        </li>
        <li>
            <h3>Latest news</h3>
            <div>
                <?php
                $result = mysql_query("
                    SELECT news.*
                    FROM news
                    ORDER BY date DESC
                    LIMIT 4");
                ?>
                <?php while ($news = mysql_fetch_array($result, MYSQL_ASSOC)): ?>
                    <div class="footer-news">
                        <a class="listview-heading">
                            <h4><?php echo $news['title'] ?></h4>
                        </a>
                        <p class="date">
                            <span><?php echo date('Y-m-d H:i:s' ,strtotime($news['date'])) ?></span>
                        </p>
                    </div>
                <?php endwhile ?>
            </div>
        </li>
    </ul>
</div>