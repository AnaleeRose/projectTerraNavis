<!-- table method -->
                <table id="chooseThumbTable" class="chooseThumbTable hiddenThumb"> <!-- -->
                    <tr>
                        <?php
                        while ($row = $getPictures->fetch_assoc()) {
                            if ($pos++ % COLS === 0 && !$firstRow) {
                                echo '</tr><tr>';
                            }
                            $firstRow = false;
                            ?>
                        <td><img src="<?= 'assets/profilePictures/' . $row['pic_location']; ?>" alt="<?= str_replace('_', ' ', $row['pic_name']); ?>" class="chooseThumb" data-id="<?= $row['profilePic_id'] ?>"></td>
                    <?php } ;
                        while ($pos++ % COLS) {
                            echo '<td>&nbsp;</td>';
                        }
                    ?>
                    </tr>
                </table>



<!-- div row method -->
                <div id="chooseThumbTable" class="chooseThumbTable hiddenThumb"> <!-- -->
                    <div class="profilePic_row">
                        <?php
                        $x = 0;
                        while ($row = $getPictures->fetch_assoc()) {
                            if ($x < 4) {
                                ?>
                                <img src="<?= 'assets/profilePictures/' . $row['pic_location']; ?>" alt="<?= str_replace('_', ' ', $row['pic_name']); ?>" class="chooseThumb" data-id="<?= $row['profilePic_id'] ?>">
                            <?php
                            } elseif ($x >= 4) {
                                echo '</div>
                                <div class="profilePic_row">';
                                ?>
                                <img src="<?= 'assets/profilePictures/' . $row['pic_location']; ?>" alt="<?= str_replace('_', ' ', $row['pic_name']); ?>" class="chooseThumb" data-id="<?= $row['profilePic_id'] ?>">
                                <?php
                                $x = 0;
                            }
                            $x++;
                        };
                        ?>
                    </div>
                </div>
