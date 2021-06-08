<?php

namespace Temify\RepositoryPattern\Service;



class RepositoryService {

    protected static function getStubs($type)
    {
        return file_get_contents(resource_path("vendor/temify/repository-pattern-maker/stubs/$type.stub"));
    }

    public static function ImplementNow($name)
    {
        if (!file_exists($path=base_path('/Repositories')))
            mkdir($path, 0777, true);
        if (!file_exists($path=base_path('/Models/{$name}.php')))
            mkdir($path, 0777, true);

        self::MakeProvider();
        self::MakeInterface($name);
        self::MakeRepositoryClass($name);
        self::MakeModel($name);
    }

    
    /**
     * MakeInterface : make interface 
     *
     * @param  mixed $name
     * @return void
     */
    protected static function MakeInterface($name)
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],

            self::GetStubs('RepositoryInterface')
        );

        file_put_contents(base_path("/Repositories/{$name}RepositoryInterface.php"), $template);

    }    
    /**
     * MakeModel : make model
     *
     * @param  mixed $name
     * @return void
     */
    protected static function MakeModel($name)
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],

            self::GetStubs('Model')
        );

        file_put_contents(base_path("/Models/{$name}.php"), $template);

    }
    
    /**
     * MakeRepositoryClass: make repository class
     *
     * @param  mixed $name
     * @return void
     */
    protected static function MakeRepositoryClass($name)
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],
            self::GetStubs('Repository')
        );

        file_put_contents(base_path("/Repositories/{$name}Repository.php"), $template);

    }
    
    /**
     * MakeProvider : make service provider
     *
     * @return void
     */
    protected static function MakeProvider()
    {
        $template =  self::getStubs('RepositoryBackendServiceProvider');

        if (!file_exists($path=base_path('/Repositories/RepositoryBackendServiceProvider.php')))
            file_put_contents(base_path('/Repositories/RepositoryBackendServiceProvider.php'), $template);
    }
}
