import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AgendamentoModalComponent } from './agendamento-modal.component';

describe('AgendamentoModalComponent', () => {
  let component: AgendamentoModalComponent;
  let fixture: ComponentFixture<AgendamentoModalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [AgendamentoModalComponent]
    });
    fixture = TestBed.createComponent(AgendamentoModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
