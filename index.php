<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Sudoku App">
		<meta name="author" content="Cameron Morrow">

		<title>Sudoku</title>

		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.css" integrity="sha256-5a0xpHkTzfwkcKzU4wSYL64rzPYgmIVf7PO4TB5/6jQ=" crossorigin="anonymous">

		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/js/fontawesome.min.js" integrity="sha256-xLAK3iA6CJoaC89O/DhonpICvf5QmdWhcPJyJDOywJM=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="sudoku_style.css" type="text/css">
        <script src="confetti.js" crossorigin="anonymous"></script>
        <script src="sudoku_script.js" crossorigin="anonymous"></script>
   
    </head>
    <body>
        <canvas id="confetti-canvas"></canvas>
        <div class="container text-center my-auto py-auto h-100 d-flex flex-column justify-content-evenly">
            <div id="newGameDialogue">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-6 shadow">
                        <div class="modal-body p-5">
                            <h2 class="fw-bold mb-0">Cameron's Sudoku</h2>
                            <ul class="d-grid gap-4 my-4 list-unstyled">
                                <li class="d-flex gap-4">
                                    <div class="form-check form-switch my-auto py-auto">
                                        <input class="form-check-input" type="checkbox" id="highlightNum" style="height: 1.5rem; width: 3rem; " checked>
                                    </div>
                                    <h6 class="my-auto py-auto">Highlight Selected Number</h6>
                                </li>
                                <li class="d-flex gap-4">
                                    <div class="form-check form-switch my-auto py-auto">
                                        <input class="form-check-input" type="checkbox" id="autoErase" style="height: 1.5rem; width: 3rem; " checked>
                                    </div>
                                    <h6 class="my-auto py-auto">Auto Erase Notes</h6>
                                </li>
                                <li class="d-flex gap-4">
                                    <div class="form-check form-switch my-auto py-auto">
                                        <input class="form-check-input" type="checkbox" id="autoFill" style="height: 1.5rem; width: 3rem; " checked>
                                    </div>
                                    <h6 class="my-auto py-auto">Auto Fill Notes</h6>
                                </li>
                                <li class="d-flex gap-4">
                                    <div class="form-check form-switch my-auto py-auto">
                                        <input class="form-check-input" type="checkbox" id="preventError" style="height: 1.5rem; width: 3rem; " checked>
                                    </div>
                                    <h6 class="my-auto py-auto">Prevent Wrong Answer</h6>
                                </li>
                            </ul>
                            <hr>
                            <ul class="d-grid gap-4 my-4 list-unstyled">
                                <li class="d-flex justify-content-between">
                                    <h6 class="my-auto py-auto" id="difficultyLabel">Difficuty: Medium</h6>
                                    <div class="my-auto py-auto">
                                        <input type="range" class="form-range" min="1" max="5" step="1" value="3" id="difficultyRange" style="width: 40%; left:50%; position:absolute; top:65%;">
                                    </div>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-primary mt-5 w-100" data-bs-dismiss="modal" onclick="startGame()">Start Game!</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="gameContainer" class="visually-hidden">
                <h1 class="mx-auto">Sudoku</h1>
                <div class="spinner-border text-secondary mx-auto my-auto fs-1 loadingGame" style="width: 6vw; height: 6vw; position: absolute; top: 30% !important; left: 47%;" role="status">
                   
                </div>
                <h2 class="loadingGame">Harder difficulties may take longer to load.</h2>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h3 class="my-2">Settings</h3>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body text-start">
                        <h5>Assists:</h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="highlightColumn" checked>
                            <label class="form-check-label" for="highlightColumn">Highlight Column</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="highlightRow" checked>
                            <label class="form-check-label" for="highlightRow">Highlight Row</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="highlightGrid" checked>
                            <label class="form-check-label" for="highlightGrid">Highlight Grid</label>
                        </div>
                        
                        <div class="my-2">
                            <button class="btn btn-primary" type="button" id="showErrors" onclick="showErrors()">Show Errors</button>
                        </div>
                        
                        <div class="my-2">
                            <button class="btn btn-primary" type="button" id="fillNotes" onclick="fillNotes()">Fill Notes</button>
                        </div>
                        
                        <hr>
                        <h5>Styles:</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="puzzleStyle" id="puzzleStyle1" checked>
                            <label class="form-check-label w-100" for="puzzleStyle1">
                                Default Style
                                <div class="coolors-palette-widget">
                                    <div class="coolors-palette-widget_colors">
                                        <div class="is-light" style="background: rgb(112, 112, 112);">
                                        </div>
                                        <div class="is-light" style="background: rgb(184, 184, 184);">
                                        </div>
                                        <div class="is-light" style="background: rgb(235, 235, 235);">
                                        </div>
                                        <div class="is-light" style="background: rgb(255, 255, 255);">
                                        </div>
                                        <div class="is-light" style="background: rgb(144, 224, 239);">
                                        </div>
                                        
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="puzzleStyle" id="puzzleStyle2">
                            <label class="form-check-label w-100" for="puzzleStyle2">
                                Rose
                                <div class="coolors-palette-widget">
                                    <div class="coolors-palette-widget_colors">
                                        <div class="is-light" style="background: rgb(89, 13, 34);">
                                        </div>
                                        <div class="is-light" style="background: rgb(201, 24, 74);">
                                        </div>
                                        <div class="is-light" style="background: rgb(255, 77, 109);">
                                        </div>
                                        <div class="is-light" style="background: rgb(255, 197, 193);">
                                        </div>
                                        <div class="is-light" style="background: rgb(255, 240, 243);">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="puzzleStyle" id="puzzleStyle3">
                            <label class="form-check-label w-100" for="puzzleStyle3">
                                Forest
                                <div class="coolors-palette-widget">
                                    <div class="coolors-palette-widget_colors">
                                        <div class="is-light" style="background: rgb(60, 61, 40);">
                                        </div>
                                        <div class="is-light" style="background: rgb(52, 79, 44);">
                                        </div>
                                        <div class="is-light" style="background: rgb(70, 107, 59);">
                                        </div>
                                        <div class="is-light" style="background: rgb(126, 161, 116);">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="puzzleStyle" id="puzzleStyle6">
                            <label class="form-check-label w-100" for="puzzleStyle6">
                                Rainbow Style
                                <div class="coolors-palette-widget">
                                    <div class="coolors-palette-widget_colors">
                                        <div class="is-light" style="background: rgb(255, 152, 152);">
                                        </div>
                                        <div class="is-light" style="background: rgb(255, 204, 142);">
                                        </div>
                                        <div class="is-light" style="background: rgb(252, 255, 162);">
                                        </div>
                                        <div class="is-light" style="background: rgb(181, 255, 167);">
                                        </div>
                                        <div class="is-light" style="background: rgb(133, 245, 255);">
                                        </div>
                                        <div class="is-light" style="background: rgb(113, 214, 234);">
                                        </div>
                                        <div class="is-light" style="background: rgb(137, 183, 255);">
                                        </div>
                                        <div class="is-light" style="background: rgb(172, 157, 255);">
                                        </div>
                                        <div class="is-light" style="background: rgb(255, 176, 255);">
                                        </div>
                                        <div style="background: rgb(112, 112, 112);">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="puzzleStyle" id="puzzleStyle4">
                            <label class="form-check-label w-100" for="puzzleStyle4">
                                Tea
                                <div class="coolors-palette-widget">
                                    <div class="coolors-palette-widget_colors">
                                        <div class="is-light" style="background: rgb(117, 163, 109);">
                                        </div>
                                        <div class="is-light" style="background: rgb(159, 212, 150);">
                                        </div>
                                        <div class="is-light" style="background: rgb(255, 255, 255);">
                                        </div>
                                        <div class="is-light" style="background: rgb(164, 181, 161);">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="puzzleStyle" id="puzzleStyle5">
                            <label class="form-check-label w-100" for="puzzleStyle5">
                                Dark
                                <div class="coolors-palette-widget">
                                    <div class="coolors-palette-widget_colors">
                                        <div class="is-light" style="background: rgb(0, 0, 0);">
                                        </div>
                                        <div class="is-light" style="background: rgb(77, 77, 77);">
                                        </div>
                                        <div class="is-light" style="background: rgb(120, 120, 120);">
                                        </div>
                                        <div class="is-light" style="background: rgb(179, 179, 179);">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <table class="text-center sud-table mx-auto px-auto rounded-3 visually-hidden" id="game">
                    <tbody>
                        <?php
                            $sud_square_count = 1;
                            $w = 1;
                            $x = 0;
                            $y = 0;
                            $z = 0;
                            for($i = 1; $i <= 9; $i++){
                                echo '<tr>';
                                for($j = 1; $j <= 9; $j++):?>
                                    <td data-sud-col="<? echo $j; ?>" data-sud-row="<? echo $i; ?>" class="sud-row-<? echo $i; ?> sud-col-<? echo $j; ?> sud-grid-<? echo $w+(3*$z);$x = ($x+1)%3;if($x == 0){$w = ($w%3)+1;if($w == 1){$y = ($y+1)%3;if($y == 0){$z++;}}}?> sud-square-<? echo $sud_square_count; $sud_square_count++; ?> sud-square"><span class="d-none sud-num"></span><table class="d-none sud-note-table text-center mx-auto my-auto px-auto py-auto h-100 w-100" cellspacing="0" cellpadding="0"><tbody class="p-0 m-0"><tr class="p-0 m-0"><td class="note-1 p-0 m-0"></td><td class="note-2 p-0 m-0"></td><td class="note-3 p-0 m-0"></td></tr><tr class="p-0 m-0"><td class="note-4 p-0 m-0"></td><td class="note-5 p-0 m-0"></td><td class="note-6 p-0 m-0"></td></tr><tr class="p-0 m-0"><td class="note-7 p-0 m-0"></td><td class="note-8 p-0 m-0"></td><td class="note-9 p-0 m-0"></td></tr></tbody></table></td>
                                <?php endfor;
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                
                <table class="text-center mx-auto px-auto my-3 sud-tool-table rounded-3 visually-hidden" id="tools">
                    <tbody>
                        <tr>
                            <td class="num"><span class="num-value">1</span><span class="remaining-num-count">9</span></td>
                            <td class="num"><span class="num-value">2</span><span class="remaining-num-count">9</span></td>
                            <td class="num"><span class="num-value">3</span><span class="remaining-num-count">9</span></td>
                            <td class="num"><span class="num-value">4</span><span class="remaining-num-count">9</span></td>
                            <td class="num"><span class="num-value">5</span><span class="remaining-num-count">9</span></td>
                            <td onclick="toggleEraser()" class="eraser"><i class="bi bi-eraser-fill"></i></td>
                        </tr>
                        <tr>
                            <td class="num"><span class="num-value">6</span><span class="remaining-num-count">-81</span></td>
                            <td class="num"><span class="num-value">7</span><span class="remaining-num-count">9</span></td>
                            <td class="num"><span class="num-value">8</span><span class="remaining-num-count">9</span></td>
                            <td class="num"><span class="num-value">9</span><span class="remaining-num-count">9</span></td>
                            <td onclick="toggleNotes()" class="notes"><i class="bi bi-pencil"></i></td>
                            <td data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-gear-fill"></i></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-grid gap-2 col-4 mx-auto visually-hidden" id="newGameButton">
                    <button type="button" class="btn btn-lg btn-success" onclick="newGame()">New Game</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="WinModal" tabindex="-1" aria-labelledby="WinModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="WinModalLabel">Winner!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Congratulations! You solved this sudoku puzzle!
                        Your time was: xx:xx:xx
                        You used X hints
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="newGame()">New Game</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="TryAgainModal" tabindex="-1" aria-labelledby="TryAgainModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TryAgainModalLabel">Try Again!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Try again, there are errors in your solution. you can highlight all of your errors in the settings or by clicking show errors.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="showErrors()">Show Errors</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    </body>
</html>