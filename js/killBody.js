var title = document.title;
document.location = 'javascript:document.write(\'<head><title>' + title + '</title></head><body><a href="' + document.location.toString() + '">Refresh</a><h3>' + title + '</h3></body>\');document.close();'
