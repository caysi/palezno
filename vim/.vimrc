	" Encoding
set termencoding=utf-8		" Кодировка терминала, должна совпадать с той, которая используется для вывода в терминал
"set fileencoding=utf-8		" set save encoding
set fileencodings=utf8,cp1251	" возможные кодировки файлов и последовательность определения.
set encoding=utf8			"По совету Paul в этомкомментарии желательно еще выставить параметр encoding в utf8:

"===================================
"          Отоброжение
"===================================

	" Find
set hlsearch			" подсветка поиска

	" Colors
set t_Co=256			" 256 colors for terminal vim
colorscheme darkburn	" цветовая схема
syntax on				" Влючить подстветку синтаксиса
"set background=dark 	" установить цвет фона

	" Tab Stop
set tabstop=4			" таб равен 4 пробелам
set shiftwidth=4		" как я понял умный отсуп равен
set autoindent			" Включить автоотступы
set smartindent			" Включаем "умные" отспупы ( например, автоотступ после {)

" set mouse=a			" включить мышу
set nu					" Включаем нумерацию строк
set binary				" не добавлять строку автоматом в конец файла (set nobinary)

	" Невидимые символы
set list				" Показать не печатные символы
set listchars=tab:▸~,eol:¬

	" Status Bar
set showcmd				" Показывать незавершённые команды в статусбаре
set ruler				" нижнее меню

	" Wraping text by default
set wrap				" перенос
set linebreak			" перенос по окончанию слов

	" Keep more content of the bottom of the buffer
set scrolloff=5			" не доводить до конца экрана

	" Hiightlight cursor line
set cursorline			" линия под курсором

	" Сворачивание
"syn region myFold start="{" end="}" transparent fold	" можно задарь руками граници
set foldenable			" Включить сворачивание
set foldmethod=syntax	" Сворачивание по синтаксису
let php_folding=2		" для php

" Чаще всего приходится работать с файлами дампов mysql. Vim имеет поддержку SQL, но СУБД много, и они отличаются друг от друга, например по типам столбцов, и я решил по умолчанию настроить поддержку SQL СУБД MySQL:
if has("autocmd")
    autocmd BufRead *.sql set filetype=mysql
endif

" Если к плагину идет файл документации в виде txt файла, то он помещается в директорию ~/.vim/doc. После добавления документации к плагину следует запустить Vim, и выполнить команду генерации(обновления) файла тагов для всей документации в папке doc
":helptags $HOME/.vim/doc

"if has("autocmd")
if &term =~ "xterm"
	au InsertEnter * silent execute "!sed -i 's/MiscCursorShape=.*$/MiscCursorShape=TERMINAL_CURSOR_SHAPE_IBEAM/' ~/.config/Terminal/terminalrc"
	au InsertLeave * silent execute "!sed -i 's/MiscCursorShape=.*$/MiscCursorShape=TERMINAL_CURSOR_SHAPE_BLOCK/' ~/.config/Terminal/terminalrc"
	au VimLeave * silent execute "!sed -i 's/MiscCursorShape=.*$/MiscCursorShape=TERMINAL_CURSOR_SHAPE_BLOCK/' ~/.config/Terminal/terminalrc"
endif


"========================================================
" Open last active file(s) if VIM is invoked without arguments.
" http://vim.wikia.com/wiki/Open_the_last_edited_file
"========================================================
autocmd VimLeave * nested let buffernr = bufnr("$") |
    \ let buflist = [] |
    \ while buffernr > 0 |
    \	if buflisted(buffernr) |
    \	    let buflist += [ fnamemodify(bufname(buffernr), ':p') ] |
    \	endif |
    \   let buffernr -= 1 |
    \ endwhile |
    \ if (!isdirectory($HOME . "/.vim")) |
    \	call mkdir($HOME . "/.vim") |
    \ endif |
    \ call writefile(reverse(buflist), $HOME . "/.vim/buflist.txt")

autocmd VimEnter * nested if argc() == 0 && filereadable($HOME . "/.vim/buflist.txt") |
    \	for line in readfile($HOME . "/.vim/buflist.txt") |
    \	    if filereadable(line) |
    \		execute "tabedit " . line |
    \		set bufhidden=delete |
    \	    endif |
    \	endfor |
    \	tabclose 1 |
    \ endif

	" Session
autocmd VimLeave * mksession! ~/.vim/last-session.vim
"execute 'source ~/.vim/last-session.vim'
