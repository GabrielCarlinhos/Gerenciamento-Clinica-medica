import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProntuarioModalComponent } from './prontuario-modal.component';

describe('ProntuarioModalComponent', () => {
  let component: ProntuarioModalComponent;
  let fixture: ComponentFixture<ProntuarioModalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ProntuarioModalComponent]
    });
    fixture = TestBed.createComponent(ProntuarioModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
