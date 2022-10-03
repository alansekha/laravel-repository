<?php

namespace KlinikPintar\Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use KlinikPintar\Tests\BaseTestCase;

class MakeRepositoryCommandTest extends BaseTestCase
{
    /** @test */
    function it_creates_a_new_test_repository_class()
    {
        // destination path of the Foo class
        $fooClass = app_path('Repositories/TestRepository.php');

        // make sure we're starting from a clean state
        if (File::exists($fooClass)) {
            unlink($fooClass);
        }

        $this->assertFalse(File::exists($fooClass));

        // Run the make command
        Artisan::call('make:foo TestRepository User');

        // Assert a new file is created
        $this->assertTrue(File::exists($fooClass));

        // Assert the file contains the right contents
        $expectedContents = <<<CLASS
        <?php

        namespace App\Repositories;

        use App\Models\User;
        use KlinikPintar\Repository;

        class TestRepository extends Repository
        {
            /**
             * model
             *
             * @var App\Models\User
             */
            protected $model = User::class;

            /**
             * fillable data model.
             *
             * @var array
             */
            protected $fillable = [];

            /**
             * paginationable.
             *
             * @var bool
             */
            protected $paginationable = false;

            /**
             * optional pagination.
             *
             * @var bool
             */
            protected $optionalPagination = true;

            /**
             * sortable.
             *
             * @var bool
             */
            protected $sortable = true;

            /**
             * field allowed to sort.
             *
             * @var array
             */
            protected $sortAllowedFields = ['id'];

            /**
             * default sort field.
             *
             * @var string
             */
            protected $defaultSortField = null;

            /**
             * relationable.
             *
             * @var bool
             */
            protected $relationable = true;

            /**
             * field allowed to get relation.
             *
             * @var array
             */
            protected $relationAllowed = [];

            /**
             * relation autoload.
             *
             * @var mixed
             */
            protected $relation = null;
        }
        CLASS;

        $this->assertEquals($expectedContents, file_get_contents($fooClass));
    }
}
