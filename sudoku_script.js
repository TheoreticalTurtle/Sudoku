
    /****** START GAME FUNCTIONS ******/
    solution = "";
    gameWon = false;

    function getGame(){
        $('.loadingGame').removeClass('visually-hidden');
        $('#game').addClass('visually-hidden');
        $('#tools').addClass('visually-hidden');
        $.post( "sudoku_generator.php",{difficulty: $("#difficultyRange").val()} ,function(data) {
            data = jQuery.parseJSON(data);
            solution = data.solution;
            for(var i = 0; i < data.clues.length; i++){//fill in puzzle with clues
                var stridentifier = '.sud-row-' + (data.clues[i].y+1) + '.sud-col-' + (data.clues[i].x+1); //get position of clue
                $(stridentifier).children('.sud-num').removeClass('d-none'); //show clue
                $(stridentifier).addClass('auto-filled');//this class prevents player from editing prefilled clues
                $(stridentifier).addClass('num-' + data.clues[i].value); //add clue target class
                $(stridentifier).children('.sud-num').html(data.clues[i].value);// fill in value for clue
            }
            $('#game').removeClass('visually-hidden');
            $('#tools').removeClass('visually-hidden');
            $('.loadingGame').addClass('visually-hidden');
            if($('#autoFill').is(":checked")){
                fillNotes();
            }
            //do hint check
            updateRemainingNumCount();
        });
    }
    /****** GAME LOOP FUNCTIONS ******/
    //NEED TO ADD TIMER
    $(document).ready(function() {    
        $('.sud-square').click(function () {
            if(gameWon){
                win();
                return;
            }
            if($(".eraser").hasClass('sud-hover') && !$(this).hasClass('auto-filled')){//erase answer if it exists and redisplays note table
                erase($(this));
                return false;
            }
            
            if($(this).hasClass('auto-filled') || $(".num.sud-hover").length==0){//ignore prefilled numbers in puzzle
                return false;
            }
            
            if($(".eraser").hasClass('sud-hover') && $(this).children('.sud-num').hasClass('d-none')){//do nothing if answer is empty
                return false;
            }
            
            if($(this).children('.sud-num').hasClass('d-none') && $(".notes").hasClass('sud-hover')){//add new note in square
                toggleNote($(this).children('.sud-note-table'));
                return false;
            }
            if(!$(this).children('.sud-num').hasClass('d-none') && $(".notes").hasClass('sud-hover')){//ignore notes on already answered square
                return false;
            }
            if(!$(".notes").hasClass('sud-hover')){//add answer into square
                for(var i = 1; i <= 9; i++){
                    $(this).removeClass('num-'+i);
                }
                $(this).children('.sud-note-table').addClass('d-none');//hide notes table
                
                addAnswer($(this));
                
                removeNotes($(this));
                
                noteHighlights();
                
                checkWin();//check win condition
                
                updateRemainingNumCount();
                
            }
        });
    });
    function checkWin(){
        var isblank = false;
        $('.sud-num').each(function(i, obj) {
            if($(this).html() == ''){
                isblank = true;
                return false;
            }
        });
        if(isblank){
            return false;
        }
        for(var i = 1; i <= 9; i++){
            if($('.num-'+i).length != 9){
                 tryAgain();
                return false;
            }
        }
        for(var i = 1; i <= 9; i++){
            for(var j = 1; j <= 9; j++){
                if($('.sud-row-'+i+'.num-'+j).length != 1){
                    tryAgain();
                    return false;
                }
                if($('.sud-col-'+i+'.num-'+j).length != 1){
                    tryAgain();
                    return false;
                }
            }
        }
        $(".sud-square").removeClass('num-highlight');
        $('.sud-note-table').removeClass('note-highlight');
        win();
    }
    function win(){
        switchRand = Math.floor(Math.random() * 8) + 1;
        switch(switchRand) {
            case 1:
                for(i = 2; i <= 18; i++){
                    (function(i){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if(($(this).data('sud-col') + $(this).data('sud-row')) == i){
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 18){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i));
                }
            break;
            case 2:
                for(i = 2, r=18; i <= 18; i++, r--){
                    (function(i, r){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if(($(this).data('sud-col') + $(this).data('sud-row')) == r){
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 18){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i, r));
                }
            break;
            case 3:
                for(i = 2, r = 8; i <= 18; i++, r--){
                    (function(i, r){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if(($(this).data('sud-col')-$(this).data('sud-row')) == r){
                                    
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 18){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i, r));
                }
            break;
            case 4:
                for(i = 2, r = -8; i <= 18; i++, r++){
                    (function(i, r){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if(($(this).data('sud-col')-$(this).data('sud-row')) == r){
                                    
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 18){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i, r));
                }
            break;
            case 5:
                // code block
                for(i = 1; i <= 9; i++){
                    (function(i){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if($(this).data('sud-col') == i){
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 9){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i));
                }
            break;
            case 6:
                for(i = 1, r = 9; i <= 9; i++, r--){
                    (function(i, r){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if($(this).data('sud-col') == r){
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 9){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i, r));
                }
            break;
            case 7:
                for(i = 1; i <= 9; i++){
                    (function(i){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if($(this).data('sud-row') == i){
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 9){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i));
                }
            break;
            case 8:
                for(i = 1, r = 9; i <= 9; i++, r--){
                    (function(i, r){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if($(this).data('sud-row') == r){
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 9){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i, r));
                }
            break;
            default:
                for(i = 2; i <= 18; i++){
                    (function(i){
                        setTimeout(function(){
                            $('.sud-square').each(function() {
                                if(($(this).data('sud-col') + $(this).data('sud-row')) == i){
                                    $(this).animate({
                                        'font-size': '2em'
                                    }, 100, function() {
                                        // Animation complete.
                                    });
                                    $(this).animate({
                                        'font-size': '1.5em'
                                    }, 100, function() {
        
                                    });
                                }
                            });
                            if(i == 18){
                                if(!gameWon){
                                    showWinModal();
                                    gameWon = true;
                                }
                            }
                        }, 80 * i);
                    }(i));
                }
        }
    }
    function showWinModal(){
        var WinModal = new bootstrap.Modal(document.getElementById('WinModal'), {
            keyboard: false
        });
        WinModal.toggle();
        $("#newGameButton").removeClass('visually-hidden');
        startConfetti();
    }
    function tryAgain(){
        var TryAgainModal = new bootstrap.Modal(document.getElementById('TryAgainModal'), {
          keyboard: false
        });
        TryAgainModal.toggle();
    }
    /****** SETTINGS FUNCTIONS ******/
    $( document ).ready(function() {
        Hover();
        $("#highlightColumn").change(function() {
            noHover();
            Hover();
        });
        $("#highlightRow").change(function() {
            noHover();
            Hover();
        });
        $("#highlightGrid").change(function() {
            noHover();
            Hover();
        });
        $("input[name=puzzleStyle]").change(function() {
            changePuzzleStyle();
        });
        $("#difficultyRange").change(function() {
            if($("#difficultyRange").val() == 1){
                $("#difficultyLabel").html("Difficulty: Very Easy");
            }else if($("#difficultyRange").val() == 2){
                $("#difficultyLabel").html("Difficulty: Easy");
            }else if($("#difficultyRange").val() == 3){
                $("#difficultyLabel").html("Difficulty: Medium");
            }else if($("#difficultyRange").val() == 4){
                $("#difficultyLabel").html("Difficulty: Hard");
            }else{
                $("#difficultyLabel").html("Difficulty: Expert");
            } 
        });

    });
    function noHover(){
        for(i = 1; i <= 9; i++){
            $(".sud-col-"+i).unbind('mouseenter mouseleave')
            $(".sud-row-"+i).unbind('mouseenter mouseleave')
            $(".sud-grid-"+i).unbind('mouseenter mouseleave')
        }
    }
    function Hover(){
        <? for($i = 1; $i <= 9; $i++): ?>
            if($("#highlightColumn").is(':checked')){
                $(".sud-col-<? echo $i; ?>").hover(//col hover functions
                    function() {
                        $(".sud-col-<? echo $i; ?>").addClass('sud-hover');
                    }, function() {
                        $(".sud-col-<? echo $i; ?>").removeClass('sud-hover');
                    }
                );
            }
            if($("#highlightRow").is(':checked')){
                $(".sud-row-<? echo $i; ?>").hover(//row hover functions
                    function() {
                        $(".sud-row-<? echo $i; ?>").addClass('sud-hover');
                    }, function() {
                        $(".sud-row-<? echo $i; ?>").removeClass('sud-hover');
                    }
                );
            }
            if($("#highlightGrid").is(':checked')){
                $(".sud-grid-<? echo $i; ?>").hover(//grid hover functions
                    function() {
                        $(".sud-grid-<? echo $i; ?>").addClass('sud-hover');
                    }, function() {
                        $(".sud-grid-<? echo $i; ?>").removeClass('sud-hover');
                    }
                );
            }
        <? endfor; ?>
    }
    function removeNotes(cell){
        if(!$('#autoErase').is(":checked")){
            return false;
        }
        for(var i = 1; i <= 9; i++){//update notes if note hints enabled
            if(cell.hasClass('sud-row-' + i)){//remove all notes in same row
                $('.sud-row-' + i).each(function(i, obj) {
                    $(this).children('.sud-note-table').children().children().children('.note-'+$('.num.sud-hover').children('.num-value').html()).html('');
                });
            }
            if(cell.hasClass('sud-col-' + i)){//remove all notes in same column
                $('.sud-col-' + i).each(function(i, obj) {
                    $(this).children('.sud-note-table').children().children().children('.note-'+$('.num.sud-hover').children('.num-value').html()).html('');
                });
            }
            if(cell.hasClass('sud-grid-' + i)){//remove all notes in same grid
                $('.sud-grid-' + i).each(function(i, obj) {
                    $(this).children('.sud-note-table').children().children().children('.note-'+$('.num.sud-hover').children('.num-value').html()).html('');
                });
            }
        }
    }
    
    /****** TOOL TABLE FUNCTIONS ******/
    $(document).ready(function() {
        $('.num').click(function () {
                
            if($(".eraser").hasClass('sud-hover')){//unselect eraser
                $(".eraser").removeClass('sud-hover');
            }
            
            $(".num").removeClass('sud-hover');//unselect other numbers
            
            $(this).addClass('sud-hover');//select this number

            numHighlights($(this).html());
            noteHighlights($(this));
        });
    });
    function toggleEraser(){
        if($(".eraser").hasClass('sud-hover')){
            $(".eraser").removeClass('sud-hover');
        }else{
            $(".eraser").addClass('sud-hover');
            
            $(".notes").removeClass('sud-hover');
            $(".num").removeClass('sud-hover');
            
            $(".sud-square").removeClass('num-highlight');
            $('.sud-note-table').removeClass('note-highlight');
        }
    }
    function toggleNotes(){
        if($(".notes").hasClass('sud-hover')){
            $(".notes").removeClass('sud-hover');
        }else{
            $(".notes").addClass('sud-hover');
            $(".eraser").removeClass('sud-hover');
        }
    }
    
    /****** PUZZLE FUNCTIONS ******/
    function erase(cell){
        cell.removeClass('num-' + cell.children('.sud-num').html());
        cell.children('.sud-num').html('');
        cell.children('.sud-num').addClass('d-none');
        cell.children('.sud-note-table').removeClass('d-none');
        cell.removeClass('sud-solution-error');
        updateRemainingNumCount();
    }
    function toggleNote(note){
        note.removeClass('d-none');
        if(note.children().children().children('.note-'+$('.num.sud-hover').children('.num-value').html()).html() == ''){
            note.children().children().children('.note-'+$('.num.sud-hover').children('.num-value').html()).html($('.num.sud-hover').children('.num-value').html());//I don't like how complicated this is
        }else{
            note.children().children().children('.note-'+$('.num.sud-hover').children('.num-value').html()).html('');//I don't like how complicated this is
        }
        noteHighlights();
    }
    function noteHighlights(note = null){
        if($('#highlightNum').is(":checked")){
            clearNoteHighlights();
            $('.sud-note-table').each(function(i, obj) {//add note highlights to notes that contain the same number
                if($(this).children().children().children('.note-'+$('.num.sud-hover').children('.num-value').html()).html() != '' && $('.num.sud-hover').children('.num-value').html() != undefined){
                    $(this).addClass('note-highlight');
                }
            });
        }else{
            clearNoteHighlights();
        }
    }
    function numHighlights(){
        $(".sud-square").removeClass('num-highlight');//remove highlight from all squares
        if($('#highlightNum').is(":checked")){
            if($('.num.sud-hover').children('.num-value').html() != null)
                $(".num-"+$('.num.sud-hover').children('.num-value').html()).addClass('num-highlight');//add highlights to squares that contain the same number
        }
    }
    function clearNoteHighlights(){
        $('.sud-note-table').removeClass('note-highlight');//remove note highlights from all notes
    }
    function addAnswer(cell){
        cell.children('.sud-num').removeClass('d-none');//show answer
        cell.children('.sud-num').html($('.num.sud-hover').children('.num-value').html());//fill in answer
        cell.addClass('num-' + cell.children('.sud-num').html());//add target class
        numHighlights(cell.children('.sud-num').html());
    }
    function changePuzzleStyle(){
        removeAllClasses();
        if($("#puzzleStyle1").is(":checked")){
            
        }
        else if($("#puzzleStyle2").is(":checked")){
            $('.sud-square').addClass('rose');
        }
        else if($("#puzzleStyle3").is(":checked")){
            $('.sud-square').addClass('forest');
        }
        else if($("#puzzleStyle4").is(":checked")){
            $('.sud-square').addClass('tea');
        }
        else if($("#puzzleStyle5").is(":checked")){
            $('.sud-square').addClass('dark');
        }
        else if($("#puzzleStyle6").is(":checked")){
            $('.sud-square').addClass('rainbow');
        }
    }
    function removeAllClasses(){
        $('.sud-square').removeClass('rose');
        $('.sud-square').removeClass('forest');
        $('.sud-square').removeClass('tea');
        $('.sud-square').removeClass('dark');
        $('.sud-square').removeClass('rainbow');
    }
    function fillNotes(){
        $('.sud-square').each(function(i, obj) {
            if($(this).hasClass('auto-filled')){
                return;
            }
            for(var i = 1; i <= 9; i++){
                if($(this).hasClass('num-'+i))
                return;
            }
            $(this).children('.sud-note-table').removeClass('d-none');
            for(var i = 1; i<= 9; i++){
                $(this).children('.sud-note-table').children().children().children('.note-'+i).html(i);
            }
            for(var i = 1; i<= 9; i++){
                if($(this).hasClass('sud-col-'+i)){
                    for(var j = 1; j<= 9; j++){
                        if($('.sud-col-'+i+'.num-'+j).length > 0){
                            $(this).children('.sud-note-table').children().children().children('.note-'+j).html('');
                        }
                    }
                }
                if($(this).hasClass('sud-row-'+i)){
                    for(var j = 1; j<= 9; j++){
                        if($('.sud-row-'+i+'.num-'+j).length > 0){
                            $(this).children('.sud-note-table').children().children().children('.note-'+j).html('');
                        }
                    }
                }
                if($(this).hasClass('sud-grid-'+i)){
                    for(var j = 1; j<= 9; j++){
                        if($('.sud-grid-'+i+'.num-'+j).length > 0){
                            $(this).children('.sud-note-table').children().children().children('.note-'+j).html('');
                        }
                    }
                }
            }
        });
    }
    function showErrors(){
        for(i = 1; i <= 9; i++){
            for(j = 1; j <= 9; j++){
                if($('.sud-row-'+i+'.sud-col-'+j).children('.sud-num').html() != solution[i-1][j-1] && $('.sud-row-'+i+'.sud-col-'+j).children('.sud-num').html() != ''){
                    $('.sud-row-'+i+'.sud-col-'+j).addClass('sud-solution-error');
                }
            }
        }
    }
    function solve(){
        for(i = 1; i <= 9; i++){
            for(j = 1; j <= 9; j++){
                $('.sud-row-'+i+'.sud-col-'+j).children('.sud-num').html(solution[i-1][j-1]);
                $('.sud-row-'+i+'.sud-col-'+j).addClass('num-' + solution[i-1][j-1]);//add target class
                $('.sud-row-'+i+'.sud-col-'+j).children('.sud-note-table').addClass('d-none');//hide notes table
                $('.sud-row-'+i+'.sud-col-'+j).children('.sud-num').removeClass('d-none');//show answer
            }
        }
        checkWin();//check win condition
    }
    function clearGameBoard(){
        $('.sud-square').children('.sud-num').addClass('d-none');
        $('.sud-square').children('.sud-note-table').addClass('d-none');
        for(var i = 1; i<= 9; i++){
            $('.sud-square').children('.sud-note-table').children().children().children('.note-'+i).html("");
        }
        $('.sud-square').removeClass('auto-filled');
        $('.sud-square').children('.sud-num').html("");
        for(i = 1; i <= 9; i++)
            $('.sud-square').removeClass('num-'+i);
    }
    function newGame(){
        stopConfetti();
        clearGameBoard();
        $("#newGameButton").addClass('visually-hidden');
        gameWon = false;
        solution = "";
        $('#newGameDialogue').removeClass('visually-hidden');
        $('#gameContainer').addClass('visually-hidden');
    }
    function startGame(){
        getGame();
        $('#newGameDialogue').addClass('visually-hidden');
        $('#gameContainer').removeClass('visually-hidden');
    }
    function updateRemainingNumCount(){
        for(i = 1; i <= 9; i++){
            $('.num').children('.remaining-num-count').eq(i-1).html(9-$('.sud-square.num-'+$('.num').children('.num-value').eq(i-1).html()).length);
        }
    }