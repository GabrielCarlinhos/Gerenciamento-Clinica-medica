import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConsultaModalComponent } from './consulta-modal.component';

describe('ConsultaModalComponent', () => {
  let component: ConsultaModalComponent;
  let fixture: ComponentFixture<ConsultaModalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ConsultaModalComponent]
    });
    fixture = TestBed.createComponent(ConsultaModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
