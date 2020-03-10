<?php

namespace unit\entities\Library\Author;

use library\entities\Library\Book\Book;
use library\entities\Meta;
use Codeception\Test\Unit;

class BookCreateTest extends Unit
{
    public function testSuccess()
    {
        $book = Book::create(
            $name = 'Name',
            $isbn = '1234567890111',
            $slug = 'name-1234567890111',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($name, $book->name);
        $this->assertEquals($isbn, $book->isbn);
        $this->assertEquals($slug, $book->slug);
        $this->assertEquals($meta, $book->meta);
    }
}
