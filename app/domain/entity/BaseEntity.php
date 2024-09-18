<?php

namespace app\domain\entity;

class BaseEntity {

    private bool $active;
    private string $createdAt;
    private string $updatedAt;
    private string $createdBy;
    private string $updatedBy;

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): string {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedBy(): string {
        return $this->createdBy;
    }

    public function setCreatedBy(string $createdBy): void {
        $this->createdBy = $createdBy;
    }

    public function getUpdatedBy(): string {
        return $this->updatedBy;
    }

    public function setUpdatedBy(string $updatedBy): void {
        $this->updatedBy = $updatedBy;
    }

    public function setActive(bool $active): void {
        $this->active = $active;
    }

    public function getActive(): bool {
        return $this->active;
    }

}