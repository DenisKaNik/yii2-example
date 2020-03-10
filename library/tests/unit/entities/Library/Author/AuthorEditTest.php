<?php

namespace unit\entities\Library\Author;

use library\entities\Library\Author;
use library\entities\Meta;
use Codeception\Test\Unit;

class AuthorEditTest extends Unit
{
    public function testSuccess()
    {
        $author = Author::create(
            $first_name = 'FirstName',
            $last_name = 'LastName',
            $slug = 'firstname-lastname',
            $meta = new Meta('Title', 'Description', 'Keywords')
        );

        $author->edit(
            $first_name = 'FirstName-NEW',
            $last_name = 'LastName-NEW',
            $slug = 'firstname-lastname-new',
            $meta = new Meta('Title-NEW', 'Description-NEW', 'Keywords-NEW')
        );

        $this->assertEquals($first_name, $author->first_name);
        $this->assertEquals($last_name, $author->last_name);
        $this->assertEquals($slug, $author->slug);
        $this->assertEquals($meta, $author->meta);
    }
}
