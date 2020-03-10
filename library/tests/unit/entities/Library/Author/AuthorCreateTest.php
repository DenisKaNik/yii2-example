<?php

namespace unit\entities\Library\Author;

use library\entities\Library\Author;
use library\entities\Meta;
use Codeception\Test\Unit;

class AuthorCreateTest extends Unit
{
    public function testSuccess()
    {
        $author = Author::create(
            $first_name = 'FirstName',
            $last_name = 'LastName',
            $slug = 'firstname-lastname',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $this->assertEquals($first_name, $author->first_name);
        $this->assertEquals($last_name, $author->last_name);
        $this->assertEquals($slug, $author->slug);
        $this->assertEquals($meta, $author->meta);
    }
}
