<?php
while ($row = $r->fetch_assoc()) {
    $elemName = $row['element_name'];
    $elemContents = $row['content'];
    // $elemContents = nl2br($row['content']);
        switch ($elemName) {
            case strpos($elemName, 'p'):
                echo '<p class="readArticleElement readArticleP">' . $elemContents . '</p>';
                break;

            case strpos($elemName, 'he'): {
                $heading_num = substr($elemName, 7, 1);
                $element_class = 'h' . $heading_num;
                echo '<' . $element_class . ' class="readArticleElement readArticleHeading readArticle ' . $element_class . '">' . $elemContents . '</' . $element_class .'>';
                break;
            } // heading

            case strpos($elemName, 'hr');
                    echo '<hr class="readArticleElement readArticleHr">';
                break;

            case (strpos($elemName, 'ul') !== false);
                if ($row['is_first_li'] === '1') echo '<ul class="readArticleElement readArticleUl">';
                    if ($elemContents != "::empty::") echo '<li>' . $elemContents . '</li>';
                if ($row['is_last_li'] === '1') echo '</ul data-crap>';
                break;

            case (strpos($elemName, 'ol') !== false);
                if ($row['is_first_li'] === '1') echo '<ol class="readArticleElement readArticleOl">';
                echo '<li>' . $elemContents . '</li>';
                if ($row['is_last_li'] === '1') echo '</ol data-crap>';
                break;

            default:
                echo '<p class="formNotice formNotice_Error">Mistake: ' . $elemName . '</p>';
                break;
        } // switch END
} // while END
// } else {echo 'why';} // foreach END


