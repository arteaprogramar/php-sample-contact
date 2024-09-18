<?php

namespace app\domain\cases;

use app\domain\BaseCase;
use app\domain\entity\ContactEntity;
use app\infrastructure\repository\ContactRepository;

class SyncContact extends BaseCase {

    private ContactRepository $model;
    private string $action;

    public function __construct() {
        $this -> model = new ContactRepository();
    }

    protected function transform(): array {
        /** @var ContactEntity $request **/
        $request = $this -> getAttributes()['param'];
        $this -> action = $this -> getAttributes()['action'];

        $params = [
            'p' => $request -> getPhone(),
            'n' => $request -> getName(),
            'f' => $request -> getFirstName(),
            'e' => $request -> getEmail(),
        ];

        if ($this->action == ACTION_UPDATE) {
            $params['i'] = $request -> getId();
        }

        return $params;
    }

    public function execute(): BaseCase {
        $builder = $this -> transform();
        $customData = $this -> action == ACTION_UPDATE ? $this -> model -> update($builder) : $this -> model -> create($builder);
        $this -> setData($customData);
        return $this;
    }

}