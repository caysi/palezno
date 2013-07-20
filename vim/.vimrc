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
set incsearch			" Поиск по набору текста (очень полезная функция)

	" Colors
set t_Co=256			" 256 colors for terminal vim
colorscheme darkburn	" цветовая схема
syntax on				" Влючить подстветку синтаксиса
"set background=dark 	" установить цвет фона

	" Tab Stop
set tabstop=4			" таб равен 4 пробелам
set shiftwidth=4		" как я понял умный отсуп равен
"set softtabstop=4		" хз
set autoindent			" Включить автоотступы
set smartindent			" Включаем "умные" отспупы ( например, автоотступ после {)

	" Формат строки состояния
set statusline=%<%f%h%m%r\ %b\ %{&encoding}\ 0x\ \ %l,%c%V\ %P 
set laststatus=2

	" TODO ПРОВЕРИТЬ
"set fo+=cr				" Fix <Enter> for comment
"set sessionoptions=curdir,buffers,tabpages	" Опции сесссий

" set mouse=a			" включить мышу
set nu					" Включаем нумерацию строк
set binary				" не добавлять строку автоматом в конец файла (set nobinary)
"set expandtab			" Преобразование Таба в пробелы

	" Невидимые символы
set list				" Показать не печатные символы
set listchars=trail:·,tab:▸~,eol:¬

	" Status Bar
set showcmd				" Показывать незавершённые команды в статусбаре
set ruler				" Нижнее меню положение курсора всё время

	" Wraping text by default
set wrap				" перенос
set linebreak			" перенос по окончанию слов

	" Keep more content of the bottom of the buffer
set scrolloff=5			" не доводить до конца экрана

	" Hiightlight cursor line
set cursorline			" линия под курсором

	" Включаем filetype плугин. Настройки, специфичные для определынных файлов мы разнесём по разным местам
filetype on				" Включение фаилтайпов
filetype plugin on		" Включение фаилтайпов или .vim/frplugin
"au BufRead,BufNewFile *.phps    set filetype=php
"au BufRead,BufNewFile *.thtml    set filetype=php
"autocmd FileType php set dictionary=~/.vim/ftplugin/php.vim

	" Сворачивание
"syn region myFold start="{" end="}" transparent fold	" можно задарь руками граници
"set foldenable			" Включить сворачивание
"set foldmethod=syntax	" Сворачивание по синтаксису
let php_folding=2		" для php

"set foldmethod=expr
set foldcolumn=2		" Показать где есть фолдинги

" Чаще всего приходится работать с файлами дампов mysql. Vim имеет поддержку SQL, но СУБД много, и они отличаются друг от друга, например по типам столбцов, и я решил по умолчанию настроить поддержку SQL СУБД MySQL:
if has("autocmd")
    autocmd BufRead *.sql set filetype=mysql
endif

" Если к плагину идет файл документации в виде txt файла, то он помещается в директорию ~/.vim/doc. После добавления документации к плагину следует запустить Vim, и выполнить команду генерации(обновления) файла тагов для всей документации в папке doc
":helptags $HOME/.vim/doc

" TODO Убрать дублирование
if &term =~ "xterm" && filewritable($HOME."/.config/xfce4/terminal/terminalrc")
	au InsertEnter * silent execute "!sed -i 's/MiscCursorShape=.*$/MiscCursorShape=TERMINAL_CURSOR_SHAPE_IBEAM/' ~/.config/xfce4/terminal/terminalrc"
	au InsertLeave * silent execute "!sed -i 's/MiscCursorShape=.*$/MiscCursorShape=TERMINAL_CURSOR_SHAPE_BLOCK/' ~/.config/xfce4/terminal/terminalrc"
	au VimLeave * silent execute "!sed -i 's/MiscCursorShape=.*$/MiscCursorShape=TERMINAL_CURSOR_SHAPE_BLOCK/' ~/.config/xfce4/terminal/terminalrc"
elseif &term =~ "xterm" && filewritable($HOME."/.config/Terminal/terminalrc")
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

"=====================================================
"               Горячие клавишы
"=====================================================

	" C-c and C-v - Copy/Paste в "глобальный клипборд"
vmap <C-C> "+yi
imap <C-V> <esc>"+gPi

	" F2 - быстрое сохранение
nmap <F2> :w<cr>
vmap <F2> <esc>:w<cr>i
imap <F2> <esc>:w<cr>i
	" С-q - выход из Vim
map <C-Q> <Esc>:qa<cr>

	" Редко когда надо [ без пары =)
imap [ []<LEFT>
	" Аналогично и для {
imap {<CR> {<CR>}<Esc>O



" Автозавершение слов по tab =)
function InsertTabWrapper()
	let col = col('.') - 1
	if !col || getline('.')[col - 1] !~ '\k'
		return "\<tab>"
	else
		return "\<c-p>"
	endif
endfunction
imap <tab> <c-r>=InsertTabWrapper()<cr>

	" Слова откуда будем завершать
set complete=""
	" Из текущего буфера
set complete+=.
	" Из словаря
set complete+=k
	" Из других открытых буферов
set complete+=b
	" из тегов
set complete+=t


"=========================
"     PHP настройки
"=========================

set dictionary=~/.vim/dic/phpFuncList.txt	" Используем словарь PHP для автодополнения,http://lerdorf.com/funclist.txt
" Сделаем удобную навигацию по мануалу PHP
"set keywordprg=~/.vim/bin/php_doc

" Полезные "быстрые шаблоны"
" Вывод отладочной информации
iabbrev dbg echo '<xmp>'; var_dump( ); echo '</xmp>'; //TODO DELETE
iabbrev vd F::var_dump(); //TODO DELETE
iabbrev vdo F::var_dump_old(); //TODO DELETE
iabbrev tm echo 'File: '.__FILE__.', line: '.__LINE__."\n<br>"; //TODO DELETE


"=====================================================
"                 GUI
"=====================================================
"set guioptions-=T		" Скрыть панель в gui версии ибо она не нужна
