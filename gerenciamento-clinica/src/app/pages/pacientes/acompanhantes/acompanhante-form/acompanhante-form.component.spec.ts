import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AcompanhanteFormComponent } from './acompanhante-form.component';

describe('AcompanhanteFormComponent', () => {
  let component: AcompanhanteFormComponent;
  let fixture: ComponentFixture<AcompanhanteFormComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [AcompanhanteFormComponent]
    });
    fixture = TestBed.createComponent(AcompanhanteFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
